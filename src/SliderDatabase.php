<?php

namespace Netzhirsch\ContaoSliderBundle;

use Contao\DC_Table;
use Contao\System;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Netzhirsch\ContaoSliderBundle\Entity\Slider;
use Netzhirsch\ContaoSliderBundle\Repository\SliderRepository;

class SliderDatabase
{
    private EntityManagerInterface $entityManager;
    private ManagerRegistry $managerRegistry;

    public function __construct(EntityManagerInterface $entityManager,ManagerRegistry $managerRegistry)
    {
        $this->entityManager = $entityManager;
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @throws \Exception
     */
    public function saveToSlider($value,DC_Table $dc)
    {
        $field = $dc->field;
        if ($field == 'type')
            return $value;

        if (empty($value))
            $value = 0;
        $breakpoint = $this->getBreakpoint($field);
        $field = str_replace('nh_'.$breakpoint.'_', '', $field);

        $em = $this->entityManager;
        /** @var SliderRepository $repo */
        $repo = $em->getRepository(Slider::class);
        $slider = $repo->findOneBy(['contentElementId' => $dc->id,'breakpoint' => $breakpoint]);
        if (empty($slider)) {
            $slider = new Slider();
            $slider->setContentElementId($dc->id);
            $slider->setBreakpoint($breakpoint);
        }
        $methodName = ucfirst($field);
        if (method_exists($slider, 'set'.$methodName)) {
            $slider->{'set'.$methodName}($value);
        }  else {
            throw new \Exception('Keinen setter Method für '.$methodName.' gefunden');
        }

        if (!$em->isOpen()) {
            $em = $this->managerRegistry->resetManager();
        }
        $em->persist($slider);
        $em->flush();

        // workaround to disable default save method
        if ($this->isSliderContent($dc)) {
            $dc->field = 'type';
            return 'slider_start';

        }

        return $value;
    }

    public function loadFromSlider($value,DC_Table $dc)
    {
        $field = $dc->field;
        $breakpoint = $this->getBreakpoint($field);
        $fieldInDatabase = str_replace('nh_'.$breakpoint.'_', '', $field);
        $em = $this->entityManager;
        /** @var SliderRepository $repo */
        $repo = $em->getRepository(Slider::class);
        $slider = $repo->findOneBy(['contentElementId' => $dc->id,'breakpoint' => $breakpoint]);
        if (empty($slider))
            return $value;
        $methodName = ucfirst($fieldInDatabase);
        if (method_exists($slider, 'is'.$methodName)) {
            $found = $slider->{'is'.$methodName}();
        } else if (method_exists($slider, 'get'.$methodName)) {
            $found = $slider->{'get'.$methodName}();
        } else if (method_exists($slider, 'has'.$methodName)) {
            $found = $slider->{'get'.$methodName}();
        } else {
            throw new \Exception('Keinen getter, is oder has Method für '.$methodName.' gefunden');
        }
        if (empty($found))
            return $value;
        if (
            ($dc->field == 'nh_xs_arrows' && $found == 'inherited')
            || ($dc->field == 'nh_xs_centerMode' && $found == 'inherited')
            || ($dc->field == 'nh_xs_dots' && $found == 'inherited')
        ) {
            return 'show';
        }
        return $found;
    }

    public function loadInherited(DC_Table $dc): array
    {
        $options = ['show' => 'anzeigen' ,'hide' => 'verstecken'];
        if ($dc->field == 'nh_xs_arrows' || $dc->field == 'nh_xs_centerMode' || $dc->field == 'nh_xs_dots') {
            return $options;
        }
        $options['inherited'] = 'vererbt';
        return array_reverse($options);
    }

    public function updateSliderJavaScript(DC_Table $dc): void
    {
        if (!$this->isSliderContent($dc))
            return;
        $em = $this->entityManager;
        $repo = $em->getRepository(Slider::class);
        $sliders = $repo->findBy(['contentElementId' => $dc->id]);
        $settings = $this->settings($sliders);
        $projectDir = System::getContainer()->get('kernel')->getProjectDir();
        $dir = $projectDir
            .DIRECTORY_SEPARATOR
            .'vendor'
            .DIRECTORY_SEPARATOR
            .'netzhirsch'
            .DIRECTORY_SEPARATOR
            .'contao-slider-bundle'
            .DIRECTORY_SEPARATOR
            .'public'
        ;
        $jsFile = $dir.DIRECTORY_SEPARATOR.'mySlickTemplate.js';
        /** @var Slider $firstSlider */
        $firstSlider = $sliders[array_key_first($sliders)];
        $version = $firstSlider->getVersion();
        $version++;
        /** @var Slider $slider */
        foreach ($sliders as $slider) {
            $slider->setVersion($version);
            $em->persist($slider);
        }
        if (file_exists($jsFile) && count($settings) > 0) {
            $content = file_get_contents($jsFile);
            $content = str_replace('__setting__', json_encode($settings),$content);
            $content = str_replace('__class__', "'.nh-slick-".$dc->id."'",$content);
            $filename = $dir.DIRECTORY_SEPARATOR.'mySlick-ceId-'.$dc->id.'-v-'.$version.'.js';
            file_put_contents($filename, $content);
            $oldFile = $dir.DIRECTORY_SEPARATOR.'mySlick-ceId-'.$dc->id.'-v-'.--$version.'.js';
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        $em->flush();
    }
    private function getBreakpoint($field): string
    {
        $breakpoint = '';
        if (str_starts_with($field, 'nh_xs')) {
            $breakpoint = 'xs';
        } elseif (str_starts_with($field, 'nh_md')) {
            $breakpoint = 'md';
        } elseif (str_starts_with($field, 'nh_sm')) {
            $breakpoint = 'sm';
        } elseif (str_starts_with($field, 'nh_lg')) {
            $breakpoint = 'lg';
        } elseif (str_starts_with($field, 'nh_xl')) {
            $breakpoint = 'xl';
        } elseif (str_starts_with($field, 'nh_xxl')) {
            $breakpoint = 'xxl';
        }
        return $breakpoint;
    }

    private function isSliderContent(DC_Table $dc): bool
    {
        return str_contains($dc->palette, '{xs_legend}');
    }

    private function settings(array $sliders): array
    {
        $settings = [];
        /** @var Slider $slider */
        foreach ($sliders as $slider) {
            if ($slider->getBreakpoint() == 'xs') {
                $settings = $this->globalSettings($slider);
            }
            $settings['responsive'][] = match ($slider->getBreakpoint()) {
                'sm' => $this->breakpointSettings($slider, 576),
                'md' => $this->breakpointSettings($slider, 768),
                'lg' => $this->breakpointSettings($slider, 992),
                'xl' => $this->breakpointSettings($slider, 1200),
                'xxl' => $this->breakpointSettings($slider, 1400),
                default => [],
            };
        }
        return $settings;
    }

    private function breakpointSettings(Slider $slider,int $breakpoint): array
    {
        $settings = ['breakpoint' => $breakpoint,];
        if (!empty($slider->getSlidesToShow())) {
            $settings['settings']['slidesToShow'] = $slider->getSlidesToShow();
        }
        if (!empty($slider->getSlidesToScroll())) {
            $settings['settings']['slidesToScroll'] = $slider->getSlidesToScroll();
        }
        if ($slider->getArrows() == 'show' || $slider->getArrows() == 'hide') {
            $settings['settings']['arrows'] = $slider->getArrows() == 'show';
        }
        if ($slider->getCenterMode() == 'show' || $slider->getCenterMode() == 'hide') {
            $settings['settings']['centerMode'] = $slider->getCenterMode() == 'show';
        }
        if ($slider->getDots() == 'show' || $slider->getDots() == 'hide') {
            $settings['settings']['dots'] = $slider->getDots() == 'show';
        }
        return $settings;
    }

    private function globalSettings(Slider $slider): array
    {
        $settings = [
            'mobileFirst' => true,
            'adaptiveHeight' => $slider->isAdaptiveHeight(),
            'autoplay' => $slider->isAutoplay(),
            'arrows' => $slider->getArrows() == 'show',
            'centerMode' => $slider->getCenterMode() == 'show',
            'centerPadding' => $slider->getCenterPadding(),
            'dots' => $slider->getDots() == 'show',
            'draggable' => $slider->isDraggable(),
            'infinite' => $slider->isInfinite(),
            'initialSlide' => $slider->getInitialSlide(),
            'lazyLoad' => "'".$slider->getLazyLoad()."'",
            'pauseOnFocus' => $slider->isPauseOnFocus(),
            'pauseOnHover' => $slider->isPauseOnHover(),
            'pauseOnDotsHover' => $slider->isPauseOnDotsHover(),
            'slidesToShow' => empty($slider->getSlidesToShow())?1:$slider->getSlidesToShow(),
            'slidesToScroll' => empty($slider->getSlidesToScroll())?1:$slider->getSlidesToScroll(),
            'swipe' => $slider->isSwipe(),
            'swipeToSlide' => $slider->isSwipeToSlide(),
            'touchMove' => $slider->isTouchMove(),
            'variableWidth' => $slider->isVariableWidth(),
            'zIndex' => empty($slider->getZIndex())?1000:$slider->getZIndex(),
        ];
        if (!empty($slider->getSpeed())) {
            $settings['speed'] = $slider->getSpeed();
        }
        if (!empty($slider->getAutoplaySpeed())) {
            $settings['autoplaySpeed'] = $slider->getAutoplaySpeed();
        }
        if (!empty($slider->getAsNavFor())) {
            $settings['asNavFor'] = $slider->getAsNavFor();
        }
        return $settings;
    }
}
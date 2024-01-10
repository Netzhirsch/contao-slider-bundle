<?php

use Contao\System;
use Doctrine\ORM\EntityManagerInterface;
use Netzhirsch\SliderBundle\Entity\Slider;

$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'] = [['SliderDatabase','updateSliderJavaScript']];

$fields = [
    'adaptiveHeight' => [
        'label' => ['Adaptive Height',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
        ],
        'exclude' => false,
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'autoplay' => [
        'label' => ['Autoplay',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'autoplaySpeed' => [
        'label' => ['Geschwindigkeit','In Millisekunden, Wenn leer 3000ms'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'arrows' => [
        'label' => ['Pfeile anzeigen',''],
        'inputType' => 'select',
        'options_callback' => ['SliderDatabase','loadInherited'],
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'asNavFor' => [
        'label' => ['Für Navigation','Stellen Sie den Slider so ein, dass er die Navigation eines anderen Slides (Klassen- oder ID-Name) ist.'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'centerMode' => [
        'label' => ['Center-Modus','Ermöglicht eine zentrierte Ansicht mit teilweisen vorherigen/nächsten Folien. Verwendung mit ungeraden slidesToShow-Zählungen.'],
        'inputType' => 'select',
        'options_callback' => ['SliderDatabase','loadInherited'],
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'centerPadding' => [
        'label' => ['Center Padding','Side padding im Center-Modus (px or %)'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'dots' => [
        'label' => ['Navigationspunkte',''],
        'inputType' => 'select',
        'options_callback' => ['SliderDatabase','loadInherited'],
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'draggable' => [
        'label' => ['Ziehbar',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'infinite' => [
        'label' => ['Unendlich','Slides werden unendlich gescrollt. (Erstes wird letztes, letztes wird erstes)'],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'initialSlide' => [
        'label' => ['Erstes Slide','Wenn leer 0'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'lazyLoad' => [
        'label' => ['lazy Loading',''],
        'inputType' => 'select',
        'options' => ['ondemand', 'progressive'],
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'pauseOnFocus' => [
        'label' => ['Autoplay pausieren bei Fokus',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'pauseOnHover' => [
        'label' => ['Autoplay pausieren bei Hover',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'pauseOnDotsHover' => [
        'label' => ['Autoplay pausieren bei Hover der Navigationspunkte',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'slidesToShow' => [
        'label' => ['Anzahl der angezeigten Slides',''],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'slidesToScroll' => [
        'label' => ['Slides pro Seite',''],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'speed' => [
        'label' => ['Geschwindigkeit der Animation','In Millisekunden'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'swipe' => [
        'label' => ['Wischgesten aktivieren',''],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'swipeToSlide' => [
        'label' => ['Wischen für nächstes Slide','Ermöglichen Sie Benutzern, unabhängig von slidesToScroll direkt zu einer Folie zu ziehen oder zu wischen.'],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'touchMove' => [
        'label' => ['Slide-Bewegung per Touch',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'variableWidth' => [
        'label' => ['Variable Breite der Slides',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
    'zIndex' => [
        'label' => ['zIndex','Standard, wenn nicht gesetzt 1000'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [['SliderDatabase', 'saveToSlider']],
        'load_callback' => [['SliderDatabase', 'loadFromSlider']],
    ],
];

$palettes = [];
$palettes[] = '{type_legend},type';
$breakpoints = [
    'xs',
    'sm',
    'md',
    'lg',
    'xl',
    'xxl',
];


foreach ($breakpoints as $breakpoint) {
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'adaptiveHeight'] = $fields['adaptiveHeight'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'autoplay'] = $fields['autoplay'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'autoplaySpeed'] = $fields['autoplaySpeed'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'arrows'] = $fields['arrows'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'asNavFor'] = $fields['asNavFor'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'centerMode'] = $fields['centerMode'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'centerPadding'] = $fields['centerPadding'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'dots'] = $fields['dots'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'draggable'] = $fields['draggable'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'infinite'] = $fields['infinite'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'initialSlide'] = $fields['initialSlide'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'lazyLoad'] = $fields['lazyLoad'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'pauseOnFocus'] = $fields['pauseOnFocus'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'pauseOnHover'] = $fields['pauseOnHover'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'pauseOnDotsHover'] = $fields['pauseOnDotsHover'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'slidesToShow'] = $fields['slidesToShow'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'slidesToScroll'] = $fields['slidesToScroll'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'speed'] = $fields['speed'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'swipe'] = $fields['swipe'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'swipeToSlide'] = $fields['swipeToSlide'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'touchMove'] = $fields['touchMove'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'variableWidth'] = $fields['variableWidth'];
    $GLOBALS['TL_DCA']['tl_content']['fields']['nh_'.$breakpoint.'_'.'zIndex'] = $fields['zIndex'];
    foreach ($fields as $key => $field) {
        $newKey = 'nh_'.$breakpoint.'_'.$key;
        $GLOBALS['TL_DCA']['tl_content']['fields'][$newKey] = $field;

    }
}
foreach ($breakpoints as $breakpoint) {
    $palette = '{'.$breakpoint.'_legend},';
    $newFields = [];
    if ($breakpoint == 'xs') {
        $newFields['nh_'.$breakpoint.'_adaptiveHeight'] = $fields['adaptiveHeight'];
        $newFields['nh_'.$breakpoint.'_'.'autoplay'] = $fields['autoplay'];
        $newFields['nh_'.$breakpoint.'_'.'autoplaySpeed'] = $fields['autoplaySpeed'];
        $newFields['nh_'.$breakpoint.'_'.'asNavFor'] = $fields['asNavFor'];
        $newFields['nh_'.$breakpoint.'_'.'draggable'] = $fields['draggable'];
        $newFields['nh_'.$breakpoint.'_'.'infinite'] = $fields['infinite'];
        $newFields['nh_'.$breakpoint.'_'.'initialSlide'] = $fields['initialSlide'];
        $newFields['nh_'.$breakpoint.'_'.'lazyLoad'] = $fields['lazyLoad'];
        $newFields['nh_'.$breakpoint.'_'.'pauseOnFocus'] = $fields['pauseOnFocus'];
        $newFields['nh_'.$breakpoint.'_'.'pauseOnHover'] = $fields['pauseOnHover'];
        $newFields['nh_'.$breakpoint.'_'.'pauseOnDotsHover'] = $fields['pauseOnDotsHover'];
        $newFields['nh_'.$breakpoint.'_'.'speed'] = $fields['speed'];
        $newFields['nh_'.$breakpoint.'_'.'swipe'] = $fields['swipe'];
        $newFields['nh_'.$breakpoint.'_'.'swipeToSlide'] = $fields['swipeToSlide'];
        $newFields['nh_'.$breakpoint.'_'.'touchMove'] = $fields['touchMove'];
        $newFields['nh_'.$breakpoint.'_'.'variableWidth'] = $fields['variableWidth'];
    }
    $newFields['nh_'.$breakpoint.'_'.'arrows'] = $fields['arrows'];
    $newFields['nh_'.$breakpoint.'_'.'centerMode'] = $fields['centerMode'];
    $newFields['nh_'.$breakpoint.'_'.'centerPadding'] = $fields['centerPadding'];
    $newFields['nh_'.$breakpoint.'_'.'dots'] = $fields['dots'];
    $newFields['nh_'.$breakpoint.'_'.'slidesToShow'] = $fields['slidesToShow'];
    $newFields['nh_'.$breakpoint.'_'.'slidesToScroll'] = $fields['slidesToScroll'];
    $newFields['nh_'.$breakpoint.'_'.'zIndex'] = $fields['zIndex'];
    $palette .= implode(',',array_keys($newFields));
    $palette .= ';';
    $palettes[] = $palette;
}

$GLOBALS['TL_DCA']['tl_content']['palettes']['slider_start'] = implode(';', $palettes);

$palettes = [];
$palettes[] = '{type_legend},type';

$GLOBALS['TL_DCA']['tl_content']['palettes']['slide_start'] = implode(';', $palettes);
$GLOBALS['TL_DCA']['tl_content']['palettes']['slider_end'] = implode(';', $palettes);
$GLOBALS['TL_DCA']['tl_content']['palettes']['slide_end'] = implode(';', $palettes);

class SliderDatabase extends tl_content
{
    public function saveToSlider($value,DC_Table $dc)
    {
        if (empty($value))
            $value = 0;
        $field = $dc->field;
        $breakpoint = $this->getBreakpoint($field);
        $field = str_replace('nh_'.$breakpoint.'_', '', $field);
        $conn = $dc->Database;
        $strQuerySelect = "SELECT id FROM tl_nh_slider WHERE contentElementId = ? AND breakpoint = ?";
        $stmt = $conn->prepare($strQuerySelect);
        $result = $stmt->execute($dc->id, $breakpoint);
        $founded = $result->fetchAssoc();
        if (empty($founded)) {
            $strQuerySelect = "INSERT tl_nh_slider %s";
            $stmt = $conn->prepare($strQuerySelect);
            $stmt->set(['contentElementId' => $dc->id, 'breakpoint' => $breakpoint, $field => $value]);
            $stmt->execute();
        } else {
            $strQuerySelect = "UPDATE tl_nh_slider %s WHERE contentElementId = ? AND breakpoint = ?";
            $stmt = $conn->prepare($strQuerySelect);
            $stmt->set(['contentElementId' => $dc->id, 'breakpoint' => $breakpoint, $field => $value]);
            $stmt->execute($dc->id, $breakpoint);
        }
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
        $conn = $dc->Database;
        $strQuerySelect = "SELECT ".$fieldInDatabase." FROM tl_nh_slider WHERE contentElementId = ? AND breakpoint = ?";
        $stmt = $conn->prepare($strQuerySelect);
        $result = $stmt->execute($dc->id, $breakpoint);
        $founded = $result->fetchAssoc();
        if (
            ($dc->field == 'nh_xs_arrows' && $founded[$fieldInDatabase] == 'inherited')
            || ($dc->field == 'nh_xs_centerMode' && $founded[$fieldInDatabase] == 'inherited')
            || ($dc->field == 'nh_xs_dots' && $founded[$fieldInDatabase] == 'inherited')
        ) {
            return 'show';
        }
        if (empty($founded))
            return $value;
        return $founded[$fieldInDatabase];
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
        /** @var EntityManagerInterface $em */
        $em = System::getContainer()->get('doctrine.orm.entity_manager');
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
            .'slider-bundle'
            .DIRECTORY_SEPARATOR
            .'src'
            .DIRECTORY_SEPARATOR
            .'Resources'
            .DIRECTORY_SEPARATOR
            .'public'
        ;
        $jsFile = $dir.DIRECTORY_SEPARATOR.'mySlickDefault.js';
        $version = 1;
        /** @var Slider $slider */
        foreach ($sliders as $slider) {
            $version = $slider->getVersion();
            $version++;
            $slider->setVersion($version);
            $em->persist($slider);
        }
        if (file_exists($jsFile) && count($settings) > 0) {
            $content = file_get_contents($jsFile);
            $content = str_replace('__setting__', json_encode($settings),$content );
            $filename = $dir.DIRECTORY_SEPARATOR.'mySlick-'.$version.'.js';
            file_put_contents($filename, $content);
            unlink($dir.DIRECTORY_SEPARATOR.'mySlick-'.--$version.'.js');
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

    private function settings(array $sliders)
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

    private function breakpointSettings(Slider $slider,int $breakpoint)
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


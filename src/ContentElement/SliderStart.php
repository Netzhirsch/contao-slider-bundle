<?php

namespace Netzhirsch\ContaoSliderBundle\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\System;
use Doctrine\ORM\EntityManagerInterface;
use Netzhirsch\ContaoSliderBundle\Entity\Slider;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

class SliderStart extends ContentElement
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_nh_slider_start';

    public function __construct(
        $objElement,
        $strColumn = 'main'
    ) {
        parent::__construct($objElement, $strColumn);
    }

    /**
     * Display a wildcard in the back end
     *
     * @return string
     */
    #[\Override]
    public function generate()
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();
        if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request)) {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### Netzhirsch Slider Start ###';
            $objTemplate->title = $this->headline;

            return $objTemplate->parse();
        }
        $projectDir = System::getContainer()->get('kernel')->getProjectDir();
        try {
            $publicDir = $this->getComposerPublicDir($projectDir);
        } catch (\JsonException) {
            return parent::generate();
        }
        if (in_array($publicDir, [null, '', '0'], true)) {
            return parent::generate();
        }

        $GLOBALS['TL_CSS'][] = $publicDir.'/bundles/contaoslider/libraries/slick-carousel/slick/slick.css|static';
        $GLOBALS['TL_CSS'][] = $publicDir.'/bundles/contaoslider/libraries/slick-carousel/slick/slick-theme.css|static';
        $GLOBALS['TL_JAVASCRIPT'][] = $publicDir.'/bundles/contaoslider/libraries/slick-carousel/slick/slick.min.js|static';
        /** @var EntityManagerInterface $em */
        $em = System::getContainer()->get('doctrine.orm.entity_manager');
        $repo = $em->getRepository(Slider::class);
        $slider = $repo->findOneBy(['contentElementId' => $this->id,'breakpoint' => 'xs']);
        if (empty($slider)) {
            $GLOBALS['TL_JAVASCRIPT'][] = $publicDir.'/bundles/contaoslider/mySlickDefault.js|static';
        } else {
            $GLOBALS['TL_JAVASCRIPT'][] = $publicDir.'/bundles/contaoslider/mySlick-ceId-'.$this->id.'-v-'.$slider->getVersion().'.js|static';
        }
        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
    }

    private function getComposerPublicDir(string $projectDir): ?string
    {
        $fs = new Filesystem();

        if (!$fs->exists($composerJsonFilePath = Path::join($projectDir, 'composer.json'))) {
            return null;
        }

        $composerConfig = json_decode(file_get_contents($composerJsonFilePath), true, 512, JSON_THROW_ON_ERROR);

        if (null === ($publicDir = $composerConfig['extra']['public-dir'] ?? null)) {
            return null;
        }

        return $publicDir;
    }

}

class_alias(SliderStart::class, 'slider_start');
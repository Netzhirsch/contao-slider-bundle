<?php

namespace Netzhirsch\ContaoSliderBundle\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\System;
use Doctrine\ORM\EntityManagerInterface;
use Netzhirsch\ContaoSliderBundle\Entity\Slider;

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
    public function generate()
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();
        if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request)) {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### '.'Netzhirsch Slider Start'.' ###';
            $objTemplate->title = $this->headline;

            return $objTemplate->parse();
        }
        $buildDir = System::getContainer()->get('kernel')->getProjectDir();
        if (file_exists($buildDir.DIRECTORY_SEPARATOR.'web')) {
            $publicDir = 'web';
        } else {
            $publicDir = 'public';
        }
        $GLOBALS['TL_CSS'][] = $publicDir.'/bundles/netzhirschslider/libraries/slick-carousel/slick/slick.css|static';
        $GLOBALS['TL_CSS'][] = $publicDir.'/bundles/netzhirschslider/libraries/slick-carousel/slick/slick-theme.css|static';
        $GLOBALS['TL_JAVASCRIPT'][] = $publicDir.'/bundles/netzhirschslider/libraries/slick-carousel/slick/slick.min.js|static';
        /** @var EntityManagerInterface $em */
        $em = System::getContainer()->get('doctrine.orm.entity_manager');
        $repo = $em->getRepository(Slider::class);
        $slider = $repo->findOneBy(['contentElementId' => $this->id,'breakpoint' => 'xs']);
        $GLOBALS['TL_JAVASCRIPT'][] = $publicDir.'/bundles/netzhirschslider/mySlick-'.$slider->getVersion().'.js|static';
        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
    }

}

class_alias(SliderStart::class, 'slider_start');
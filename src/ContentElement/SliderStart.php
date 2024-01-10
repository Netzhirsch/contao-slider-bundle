<?php

namespace Netzhirsch\SliderBundle\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\System;
use Doctrine\ORM\EntityManagerInterface;
use Netzhirsch\SliderBundle\Entity\Slider;

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

        $GLOBALS['TL_CSS'][] = 'web/bundles/netzhirschslider/libraries/slick-carousel/slick/slick.css|static';
        $GLOBALS['TL_CSS'][] = 'web/bundles/netzhirschslider/libraries/slick-carousel/slick/slick-theme.css|static';
        if (!$this->isJsAlreadyLoaded('cookie.min.js')) {
            $GLOBALS['TL_JAVASCRIPT'][] = 'web/bundles/netzhirschslider/libraries/jquery/jquery.min.js|static';
        }
        $GLOBALS['TL_JAVASCRIPT'][] = 'web/bundles/netzhirschslider/libraries/slick-carousel/slick/slick.min.js|static';
        /** @var EntityManagerInterface $em */
        $em = System::getContainer()->get('doctrine.orm.entity_manager');
        $repo = $em->getRepository(Slider::class);
        $slider = $repo->findOneBy(['contentElementId' => $this->id,'breakpoint' => 'xs']);
        $GLOBALS['TL_JAVASCRIPT'][] = 'web/bundles/netzhirschslider/mySlick-'.$slider->getVersion().'.js|static';
        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
    }

    private function isJsAlreadyLoaded($filename): bool
    {
        foreach ($GLOBALS['TL_JAVASCRIPT'] as $javascript) {
            if (strrpos($javascript,$filename) !== false){
                return true;
            }
        }
        return false;
    }

}

class_alias(SliderStart::class, 'slider_start');
<?php

namespace Netzhirsch\SliderBundle\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\System;

class SliderEnd extends ContentElement
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_nh_slider_end';

    public function __construct(
        $objElement,
        $strColumn = 'main'
    )
    {
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

		if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
		{
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### ' . 'Netzhirsch Slider End' . ' ###';
			$objTemplate->title = $this->headline;

			return $objTemplate->parse();
		}
		return parent::generate();
	}

    /**
	 * Generate the module
	 */
	protected function compile()
	{
	}


}
class_alias(SliderEnd::class, 'SliderEnd');
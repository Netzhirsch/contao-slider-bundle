<?php

namespace Netzhirsch\SliderBundle\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\System;
use Symfony\Component\Filesystem\Filesystem;

class SlideDivider extends ContentElement
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_nh_slide_divider';

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
			$objTemplate->wildcard = '### ' . 'Netzhirsch Slide Start' . ' ###';
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
        $data = $this->Template->getData();
        $this->Template->setData($data);
	}

}
class_alias(SlideDivider::class, 'slide_start');
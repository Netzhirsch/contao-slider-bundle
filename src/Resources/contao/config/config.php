<?php

use Netzhirsch\SliderBundle\ContentElement\SliderStart;
use Netzhirsch\SliderBundle\ContentElement\SliderEnd;
use Netzhirsch\SliderBundle\ContentElement\SlideDivider;

$GLOBALS['TL_CTE']['netzhirsch_element_slider']['slider_start'] = SliderStart::class;
$GLOBALS['TL_CTE']['netzhirsch_element_slider']['slider_end'] = SliderEnd::class;

$GLOBALS['TL_CTE']['netzhirsch_element_slider']['slide_divider'] = SlideDivider::class;

$GLOBALS['TL_WRAPPERS']['start'][] = 'slider_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'slider_end';
$GLOBALS['TL_WRAPPERS']['separator'][] = 'slide_divider';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'slide_end';
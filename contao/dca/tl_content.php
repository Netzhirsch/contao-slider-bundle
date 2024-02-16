<?php

use Netzhirsch\ContaoSliderBundle\SliderDatabase;

$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'] = [[SliderDatabase::class,'updateSliderJavaScript']];

$fields = [
    'adaptiveHeight' => [
        'label' => ['Adaptive Height',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'exclude' => false,
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'autoplay' => [
        'label' => ['Autoplay',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'autoplaySpeed' => [
        'label' => ['Geschwindigkeit','In Millisekunden, Wenn leer 3000ms'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'arrows' => [
        'label' => ['Pfeile anzeigen',''],
        'inputType' => 'select',
        'options_callback' => [SliderDatabase::class,'loadInherited'],
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'asNavFor' => [
        'label' => ['Für Navigation','Stellen Sie den Slider so ein, dass er die Navigation eines anderen Slides (Klassen- oder ID-Name) ist.'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'centerMode' => [
        'label' => ['Center-Modus','Ermöglicht eine zentrierte Ansicht mit teilweisen vorherigen/nächsten Folien. Verwendung mit ungeraden slidesToShow-Zählungen.'],
        'inputType' => 'select',
        'options_callback' => [SliderDatabase::class,'loadInherited'],
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'centerPadding' => [
        'label' => ['Center Padding','Side padding im Center-Modus (px or %)'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'dots' => [
        'label' => ['Navigationspunkte',''],
        'inputType' => 'select',
        'options_callback' => [SliderDatabase::class,'loadInherited'],
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'draggable' => [
        'label' => ['Ziehbar',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'infinite' => [
        'label' => ['Unendlich','Slides werden unendlich gescrollt. (Erstes wird letztes, letztes wird erstes)'],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'initialSlide' => [
        'label' => ['Erstes Slide','Wenn leer 0'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'lazyLoad' => [
        'label' => ['lazy Loading',''],
        'inputType' => 'select',
        'options' => ['ondemand', 'progressive'],
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'pauseOnFocus' => [
        'label' => ['Autoplay pausieren bei Fokus',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'pauseOnHover' => [
        'label' => ['Autoplay pausieren bei Hover',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'pauseOnDotsHover' => [
        'label' => ['Autoplay pausieren bei Hover der Navigationspunkte',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'slidesToShow' => [
        'label' => ['Anzahl der angezeigten Slides','Pro Abschnitt'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'slidesToScroll' => [
        'label' => ['Anzahl Slider die auf einmal gescrollt werden',''],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'speed' => [
        'label' => ['Geschwindigkeit der Animation','In Millisekunden'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'swipe' => [
        'label' => ['Wischgesten aktivieren',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'touchMove' => [
        'label' => ['Slide-Bewegung per Touch',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'variableWidth' => [
        'label' => ['Variable Breite der Slides',''],
        'inputType' => 'checkbox',
        'eval' => [
            'tl_class'  =>  'w50',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
    ],
    'zIndex' => [
        'label' => ['zIndex','Standard, wenn nicht gesetzt 1000'],
        'inputType' => 'text',
        'eval' => [
            'tl_class'  =>  'w50',
            'rgxp' => 'natural',
            'alwaysSave' => true,
        ],
        'save_callback' => [[SliderDatabase::class, 'saveToSlider']],
        'load_callback' => [[SliderDatabase::class, 'loadFromSlider']],
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
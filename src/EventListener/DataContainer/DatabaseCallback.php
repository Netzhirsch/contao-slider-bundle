<?php

namespace Netzhirsch\ContaoSliderBundle\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DC_Table;
use Netzhirsch\ContaoSliderBundle\Service\DCAService;
use Netzhirsch\ContaoSliderBundle\Repository\SliderRepository;

class DatabaseCallback
{

    public function __construct(
        private readonly SliderRepository $sliderRepository,
        private readonly DCAService $dcaService,
    )
    {
    }

    #[AsCallback('tl_content', 'config.oncopy_callback')]
    public function onCopyContent(string $id,DC_Table $dc): void
    {
        if ($dc->getPalette() == $GLOBALS['TL_DCA']['tl_content']['palettes']['slider_start']) {
            $this->dcaService->cloneByContent($this->sliderRepository,$dc->id,$id);
        }
    }

    #[AsCallback('tl_article', 'config.oncopy_callback')]
    public function onCopyArticle(string $id,DC_Table $dc): void
    {
        $this->dcaService->cloneByArticle(
            'slider_start',
            $dc->id,
            $id,
            $this->sliderRepository
        );
    }

    #[AsCallback('tl_content', 'config.ondelete_callback')]
    public function onDeleteContent(DC_Table $dc): void
    {
        /**
         * @see BackgroundImageDatabaseCallback::onCopyContent
         */
        $row = $dc->getActiveRecord();
        if ($row['type'] == 'slider_start') {
            $this->dcaService->deleteByContent($this->sliderRepository,$dc->id);
        }
    }

    #[AsCallback('tl_article', 'config.ondelete_callback')]
    public function onDeleteArticle(DC_Table $dc): void
    {
        $this->dcaService->deleteByArticle(
            'slider_start',
            $dc->id,
            $this->sliderRepository
        );
    }
}
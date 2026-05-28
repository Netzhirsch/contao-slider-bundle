<?php

namespace Netzhirsch\ContaoSliderBundle\Service;

use Contao\ContentModel;
use Contao\CoreBundle\Framework\ContaoFramework;
use Netzhirsch\ContaoSliderBundle\Repository\SliderRepository;
use Netzhirsch\ContaoSliderBundle\SliderDatabase;
use Symfony\Component\HttpKernel\KernelInterface;

class SliderService
{
    public function __construct(
        private readonly KernelInterface $kernel,
        private readonly SliderRepository $sliderRepository,
        private readonly ContaoFramework $framework,
        private readonly SliderDatabase $sliderDatabase,
    )
    {
    }

    public function getCustomJavaScript($relative = false)
    {
        $dir  =
            'files'
            .DIRECTORY_SEPARATOR
            .'_layout'
            .DIRECTORY_SEPARATOR
            .'js'
            .DIRECTORY_SEPARATOR
            .'netzhirsch-slider'
        ;
        if ($relative) {
            return $dir;
        }
        $projectDir = $this->kernel->getProjectDir();
        return $projectDir
            .DIRECTORY_SEPARATOR
           .$dir
        ;
    }

    public function updateAll(): array
    {
        $this->framework->initialize();

        $contents = ContentModel::findBy(['type="slider_start"'], null,['order' => 'sorting ASC'])??[];

        $ids = [];
        foreach ($contents as $content) {
            $ids[] = $content->id;
        }
        if (empty($ids)) {
            return ['success' => true, 'message' => 'Keine Slider gefunden'];
        }

        $entities = $this->sliderRepository->findBy(['contentElementId' => $ids])??[];

        if (!empty($entities)) {
            foreach ($entities as $entity) {
                if ($entity->getBreakpoint() === 'xs') {
                    $this->sliderDatabase->updateSliderJavaScriptByContent($entity->getContentElementId());
                }
            }
        }
        return ['success' => true, 'message' => 'Update fertig'];
    }
}
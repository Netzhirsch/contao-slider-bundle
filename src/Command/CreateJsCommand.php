<?php

declare(strict_types=1);

namespace Netzhirsch\ContaoSliderBundle\Command;

use Contao\ContentModel;
use Contao\CoreBundle\Framework\ContaoFramework;
use Netzhirsch\ContaoSliderBundle\Repository\SliderRepository;
use Netzhirsch\ContaoSliderBundle\SliderDatabase;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'contao_slider:create_js', description: 'Hello PhpStorm')]
class CreateJsCommand extends Command
{

    public function __construct(
        private readonly SliderRepository $sliderRepository,
        private readonly ContaoFramework $framework,
        private readonly SliderDatabase $sliderDatabase,
        ?string $name = null
    )
    {
        parent::__construct($name);
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->framework->initialize();

        $contents = ContentModel::findBy(['type="slider_start"'], null,['order' => 'sorting ASC'])??[];

        $ids = [];
        foreach ($contents as $content) {
            $ids[] = $content->id;
        }
        if (empty($ids)) {
            $output->writeln('Keine Slider gefunden');
            return Command::SUCCESS;
        }

        $entities = $this->sliderRepository->findBy(['contentElementId' => $ids])??[];

        if (!empty($entities)) {
            foreach ($entities as $entity) {
                if ($entity->getBreakpoint() == 'xs') {
                    $this->sliderDatabase->updateSliderJavaScriptByContent($entity->getContentElementId());
                }
            }
        }

        return Command::SUCCESS;
    }
}

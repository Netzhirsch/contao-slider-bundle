<?php

declare(strict_types=1);

namespace Netzhirsch\ContaoSliderBundle\Command;

use Netzhirsch\ContaoSliderBundle\Service\SliderService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'contao_slider:create_js', description: 'Nach einem Update des Bundle verschwinden die JS-Datein. Mit diesem Command werden diese wieder erzeugt.')]
class CreateJsCommand extends Command
{

    public function __construct(
        private readonly SliderService $sliderService,
        ?string $name = null
    )
    {
        parent::__construct($name);
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->sliderService->updateAll();

        return Command::SUCCESS;
    }
}

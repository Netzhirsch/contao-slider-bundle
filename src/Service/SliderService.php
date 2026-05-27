<?php

namespace Netzhirsch\ContaoSliderBundle\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class SliderService
{
    public function __construct(
        private readonly KernelInterface $kernel
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
}
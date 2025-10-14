<?php

namespace Netzhirsch\ContaoSliderBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use Exception;
use Netzhirsch\ContaoSliderBundle\ContaoSliderBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Contao\CoreBundle\ContaoCoreBundle;

/**
 * Plugin for the Contao Manager.
 *
 */
class Plugin implements BundlePluginInterface, ConfigPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {

        return [
            BundleConfig::create(ContaoSliderBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
        ];

    }

    /**
     * @throws Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader, array $managerConfig): void {
        $loader->load(static function (ContainerBuilder $container): void {
            $container->addCompilerPass(new class implements CompilerPassInterface {
                public function process(ContainerBuilder $container): void {
                    $container->getAlias('logger')->setPublic(true);
                }
            });
        });
    }

}
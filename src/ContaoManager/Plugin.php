<?php

namespace Netzhirsch\SliderBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Exception;
use Netzhirsch\SliderBundle\NetzhirschSliderBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

use Contao\CoreBundle\ContaoCoreBundle;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Plugin for the Contao Manager.
 *
 */
class Plugin implements BundlePluginInterface, RoutingPluginInterface, ConfigPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {

        return [
            BundleConfig::create(NetzhirschSliderBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class,])
        ];

    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        return $resolver
            ->resolve(__DIR__.'/../Resources/config/routing.yml')
            ->load(__DIR__.'/../Resources/config/routing.yml')
            ;
    }

    /**
     * Allows a plugin to override extension configuration.
     *
     * @param string $extensionName
     * @param array  $extensionConfigs
     *
     * @return array
     */
    public function getExtensionConfig($extensionName, array $extensionConfigs)
    {
        /**
         * Füge dein Bundle zu Doctrine hinzu
         * Ab Contao 4.8 ist das nicht mehr notwendig
         * (Kernel::VERSION < '4.3' ist ab Contao 4.8 TRUE)
         */
        if ('doctrine' === $extensionName && Kernel::VERSION < '4.3')
        {
            // Mit Contao 4.8 ist das nicht mehr notwendig
            $extensionConfigs[0]['orm']['entity_managers']['default']['mappings']['NetzhirschSliderBundle'] = "";
        }

        return $extensionConfigs;
    }

    public function registerContainerConfiguration(LoaderInterface $loader, array $managerConfig): void
    {
        $loader->load(
            static function (ContainerBuilder $container) use ($loader): void {
                $loader->load('@NetzhirschSliderBundle/Resources/config/services.yml');
            }
        );
    }

}
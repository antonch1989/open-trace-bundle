<?php

use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class PlugsurfingOpenTraceExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));

        $loader->load('services.xml');
    }
}

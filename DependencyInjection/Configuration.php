<?php

namespace Cengizhan\ViewsCounterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('cengizhan_views_counter');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('use_query_builder')->defaultFalse()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

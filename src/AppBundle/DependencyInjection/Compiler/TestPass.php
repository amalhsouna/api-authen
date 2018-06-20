<?php
namespace Wynd\AppBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Wynd\AppBundle\Manager\RuleMaager;

class TestPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(RuleMaager::class)) {
            return;
        }

        $definition = $container->findDefinition(RuleMaager::class);

        $taggedServices = $container->findTaggedServiceIds('app.maill_transport');

        foreach ($taggedServices as $id => $taggedService) {
            $definition->addMethodCall('applyRules');
        }
    }

}
<?php
/**
 *
 * File: CompilerPass.php
 * User: thomas
 * Date: 03/11/12
 *
 */
namespace Arse\MenuBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class CompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('arse.menu')) {
            return;
        }

        $listControllerDefinition = $container->getDefinition('arse.menu');
//        $container->get('router')->getRouteCollection();

        foreach ($container->findTaggedServiceIds('arse.menu.listing') as $id => $attributes) {
            // for each tagged service, we need to inject the menu service into it so we can modify existing menus
            $serviceDef = $container->getDefinition(new Reference($id));
            $serviceDef->addMethodCall('setMenuService', array(new Reference('arse.menu')));

            // and we then process the instructions defined in the taggedservice->getLists();
            $listControllerDefinition->addMethodCall('processMenusFromService', array(new Reference($id)));
        }
    }
}

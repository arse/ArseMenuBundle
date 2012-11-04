<?php

namespace Arse\MenuBundle;

use Arse\MenuBundle\DependencyInjection\CompilerPass as MenuCompilerPass;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ArseMenuBundle extends Bundle
{
    // add compiler passes for plugins and store services
    public function build(ContainerBuilder $container){
        parent::build($container);

        // plugin compiler passes
        $container->addCompilerPass(new MenuCompilerPass());
    }

}

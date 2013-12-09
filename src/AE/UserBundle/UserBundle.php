<?php

namespace AE\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use AE\UserBundle\DependencyInjection\Security\Factory\WsseFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class UserBundle extends Bundle
{
    public function build(ContainerBuilder $container) {
        parent::build($container);
        
        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new WsseFactory());
    }
    
    public function getParent() {
        return "FOSUserBundle";
    }
}

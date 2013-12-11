<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        //return $this->render('AcmeDemoBundle:Welcome:index.html.twig');
        
        /*
        return $this->redirect($this->generateUrl('main'));
        
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $securityContext = $this->get('security.context');

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }
 
        $resultado = $this->render('DicarsLoginBundle:Default:login.html.twig');
        
        $resultado->setMaxAge(60);
        
        $resultado->setPublic();
        
        return $resultado;
         * 
         */
        
        return new \Symfony\Component\HttpFoundation\Response('fos_user_security_login');
    }
}

<?php

namespace AE\ConfigurarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class DefaultController extends Controller
{
    public function indexAction()
    {        
        $securityContext = $this->get('security.context');
        
        $username = $this->getUser();
               // $this->container->get('security.context')->getToken()->getUser();
        $userManager = $this->get('fos_user.user_manager');
        $usuario = $userManager->findUserByUsername($username);
        //$usuario = $this->getUser();
               
        if($usuario->isEnabled()=="1")
        {
             
            $response = $this->render('AEConfigurarBundle:Default:index.html.twig');        
            $response->setSharedMaxAge(60);
            $response->setPublic();        
            return $response;
        }
        else {
               return $this->redirect($this->generateUrl('logout'));
        }
    }
}

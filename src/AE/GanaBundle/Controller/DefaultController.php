<?php

namespace AE\GanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AEGanaBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public  function busquedaAction()
    {
        
         $securityContext = $this->get('security.context');
        
        
        if($securityContext->isGranted('ROLE_LIDER_RED'))
        {
        $ganador = $securityContext->getToken()->getUser()->getIdPersona();
        $red = NULL;
        $em = $this->getDoctrine()->getManager();
        
        if($ganador != NULL)
        {
            $sql = "select * from get_red_persona(:id)";
            $smt = $em->getConnection()->prepare($sql);
            $smt->execute(array(':id'=>$ganador->getId()));
            $req = $smt->fetch();
            
            $red = $req['red'];
        }
        
        return $this->render('AEGanaBundle:Default:busqueda.html.twig',
                array('red'=>$red));
        }
        else return $this->render('AEGanaBundle:Default:sinacceso.html.twig');
        
        
    }
    
}

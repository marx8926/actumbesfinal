<?php

namespace AE\ServicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class GanarServicesController extends Controller
{
    public function lista_redAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $sql = "select * from red";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
 
        $redes = $smt->fetchAll();
        
        $resultado= new JsonResponse($redes);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
     public function lista_lugarAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $sql = "select * from lugar";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
 
        $redes = $smt->fetchAll();
        
        $resultado= new JsonResponse($redes);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
}

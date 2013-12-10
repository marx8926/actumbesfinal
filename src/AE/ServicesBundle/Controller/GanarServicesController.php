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
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from red where activo=true";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
 
        $result = [];
        $item = array("int_red_id" => -1, "id"=>"sin red");
        
        array_push($result,$item);
        $redes = $smt->fetchAll();
        
        foreach ($redes as $value) {
          array_push($result, $value);  
        }
        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
     public function lista_lugarAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from lugar";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
 
        $redes = $smt->fetchAll();
        
        $resultado= new JsonResponse($redes);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    public function lista_celulaAction($red)
    {
        $em = $this->getDoctrine()->getManager();
        
        $celulas = $this->getDoctrine()
        ->getRepository('AEDataBundle:Celula')
        ->findBy(array('idRed' => $red, 'activo'=> true));
        
        $result = array();
        $item = array("id" => -1, "value"=>"sin red");
        
        array_push($result,$item);
        
        foreach ($celulas as $key => $value) {
            
            $item = array('id' => $value->getId(), 'value' => $value->getId());
            
            $result[] = $item;
        }
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }

    public  function personas_initAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_personas_init";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
 
       
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array( "aaData" =>$result));
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
}

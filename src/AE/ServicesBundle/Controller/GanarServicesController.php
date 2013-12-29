<?php

namespace AE\ServicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AE\DataBundle\Entity\Persona;
use AE\DataBundle\Entity\Red;

class GanarServicesController extends Controller
{
    public function lista_redAction()
    {
        $em = $this->getDoctrine()->getManager();
	
       $securityContext = $this->get('security.context');
        
       if($securityContext->isGranted('ROLE_GANAR') || $securityContext->isGranted('ROLE_CONSOLIDAR'))
       {
           $sql = "select * from red where activo=true order by id asc";
        
           $smt = $em->getConnection()->prepare($sql);
           $smt->execute();
           $redes = $smt->fetchAll();

           
       }
       else {
            $persona = $securityContext->getToken()->getUser()->getIdPersona();
            $redes = array();
            $red = $persona->getRed();
            if($red != NULL)
                $redes[] = array("int_red_id" => $red->getIntRedId(), "id"=>$red->getId());
       }
 
        $result = [];

        $item = array("int_red_id" => -1, "id"=>'Sin Red');
        
        array_push($result,$item);
        
        foreach ($redes as $value) {
          array_push($result, $value);  
        }
        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
        
        $em->clear();
       
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
        $resultado->setMaxAge(120);
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
    
    
    public function personas_allAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_personas_all";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array( "aaData" =>$result));
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    public function personas_filtro_fecha_redAction($red, $ini, $fin)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_personas_filtro(:red,:ini,:fin)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red,':ini'=>$ini,':fin'=>$fin));
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array( "aaData" =>$result));
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }

    public function personas_filtro_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_personas_filtro_red(:red)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array( "aaData" =>$result));
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    public function ganador_autocomplete_allAction()
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from view_get_ganador_all";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
       
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();       
        return $resultado;       
    }
    
    public function ganador_autocomplete_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_ganador_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red' => $red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();       
        return $resultado;
    }
}

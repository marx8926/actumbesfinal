<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ServicesBundle\Controller;

/**
 * Description of SecretariaController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;

class SecretariaController extends Controller {
    //put your code here
    
    public function sinbautizo_autocomplete_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_sin_bautizar_option(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red' => $red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();       
        return $resultado;
        
    }
    
    public function personas_autocomplete_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_personas_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red' => $red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();       
        return $resultado;
        
    }
    
    //put your code here
    public function bautizo_allAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
	
		$sql = "select * from view_get_all_bautizo";
	
		$smt = $em->getConnection()->prepare($sql);
		$smt->execute();
	
		$todo = $smt->fetchAll();
	                
		return new JsonResponse(array('aaData'=>$todo));
    }
    
    //put your code here
    public function encuentro_allAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
	
		$sql = "select * from view_get_all_encuentro";
	
		$smt = $em->getConnection()->prepare($sql);
		$smt->execute();
	
		$todo = $smt->fetchAll();
	                
		return new JsonResponse(array('aaData'=>$todo));
    }
    
}



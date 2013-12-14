<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ServicesBundle\Controller;

/**
 * Description of DiscipularServices
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DiscipularServicesController extends Controller {
    //put your code here
    
    public function miembros_nodocente_autocomplete_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_miembros_no_nivel_red(:red,:nivel,:inicio)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red' => $red, ':nivel' => 5,':inicio'=>0));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();       
        return $resultado;
    }
    
    public function persona_noestudiante_autocomplete_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_sin_nivel_red(:red,:nivel)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red' => $red, ':nivel' => '4'));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();       
        return $resultado;
    }
}

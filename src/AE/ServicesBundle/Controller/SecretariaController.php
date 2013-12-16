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
        $sql = "select * from get_sin_nivel_red(:red,:nivel)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red' => $red, ':nivel' => '0'));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();       
        return $resultado;
    }
    
}


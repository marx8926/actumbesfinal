<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfigurarServicesController
 *
 * @author Marks-Calderon
 */

namespace AE\ServicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConfigurarServicesController extends Controller {
    //put your code here
    
    public function lista_lider_redAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_lider_red_complete_all";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    public function lista_pastorAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_pastor_complete_all";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    public function lider_celula_allAction($red)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_niveles_complete_red(:red,:esc,:est)";
        
        $smt = $em->getConnection()->prepare($sql);
        
        // redes , escala, estado
        
        $smt->execute(array(':red' => $red, ':esc' => '1', ':est' => '1'));
        
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    public function lider_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_niveles_red(:red,:esc,:est)";
        
        $smt = $em->getConnection()->prepare($sql);        
        // redes , escala, estado        
        $smt->execute(array(':red' => $red, ':esc' => '2', ':est' => '1'));
        
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
}

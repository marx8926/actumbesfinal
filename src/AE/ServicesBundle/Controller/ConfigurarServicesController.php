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
        
        $sql = "select * from get_lider_complete_red(:red,:flag)";
        
        $smt = $em->getConnection()->prepare($sql);
        
        // redes , escala, estado
        
        $smt->execute(array(':red' => $red, ':flag' => TRUE));
        
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    public function lideres_redAction($red)
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
    
    public function lider_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_lider_red_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);        
        // redes , escala, estado        
        $smt->execute(array(':red' => $red));        
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    public function lideres_celula_sinasignarAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_lider_celula_sinasig_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);        
        // redes , escala, estado        
        $smt->execute(array(':red' => $red));        
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        //$resultado->setMaxAge(60);
        //$resultado->setPublic();
       
        return $resultado;
    }
    
    public function lider_libre_antecesor_red_sinasignarAction($red, $padre)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_lider_celula_sinasig_padre_red(:red,:padre)";        
        $smt = $em->getConnection()->prepare($sql);        
        // redes , padre       
        $smt->execute(array(':red' => $red, ':padre' => $padre));        
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    public function servicio_all_optionAction()
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from view_get_servicios_option";        
        $smt = $em->getConnection()->prepare($sql);        
        // redes , padre       
        $smt->execute();        
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);      
       
        return $resultado;
    }
}

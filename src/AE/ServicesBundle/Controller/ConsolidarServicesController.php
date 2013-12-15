<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ServicesBundle\Controller;

/**
 * Description of ConsolidarController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConsolidarServicesController extends Controller {
    //put your code here
    
    public function lista_consolidador_initAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_consolidador_init";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_consolidador_allAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_consolidador_all";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_consolidador_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_consolidador_red(:red)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_miembro_init_no_consolidadorAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_miembros_no_consolidador_init";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_miembro_all_no_consolidadorAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_miembros_noconsolidador_all";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_miembro_red_no_consolidadorAction($red)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_miembro_red_noconsolidador(:red)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
}

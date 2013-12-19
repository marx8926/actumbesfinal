<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ServicesBundle\Controller;

/**
 * Description of EnviarServices
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Red;
use AE\DataBundle\Entity\Celula;
use AE\DataBundle\Entity\Ubicacion;

class EnviarServicesController extends Controller {
    //put your code here
    
    public function ultimas_celula_tableAction()
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_view_last_celulas";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData' =>$result));
            
        return $resultado;
    }
    
    public function check_lider_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_check_liderred_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetch();        
        $resultado= new JsonResponse($result);
            
        return $resultado;
    }
    
    public function hijos_de_lider_optionAction($lider, $tipo)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_padre_hijo_nivel(:padre,:tipo)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':padre'=>$lider, ':tipo'=>$tipo));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
            
        return $resultado;
    }
    
    public function all_celulas_red_tablaAction($red)
    {
                
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_celulas_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData'=>$result));            
        return $resultado;
    }
    
    public function sin_celula_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_sin_celula_option(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);            
        return $resultado;
    }
    
     public function con_celula_redAction($red, $celula)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_con_celula_option(:red,:celula)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red,':celula'=>$celula));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);            
        return $resultado;
    }
    
    public function celulas_menosAction($red, $celula, $tipo)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_celula_tipo_excepto_option(:red,:cell,:tipo)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red,':cell'=>$celula,':tipo'=>$tipo));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);            
        return $resultado;
    }
}

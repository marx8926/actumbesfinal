<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\SecretariaBundle\Controller;

/**
 * Description of EncuentroController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Encuentro;

class EncuentroController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AESecretariaBundle:Default:encuentro.html.twig');
    }
    
    public function saveAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');
        $tabla = $request->request->get('tabla');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            
            $fechaConv_b = $datos['f_inicio'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $fecha_inicio = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
            
            $fechaConv_b = $datos['f_fin'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $fecha_fin = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
            
            $hora_inicio = $datos['h_inicio'];
            $hora_fin = $datos['h_fin'];
            
            $lugar = $datos['lugar'];
            $descripcion = $datos['descripcion'];
           
            $encuentro = new Encuentro();
            $encuentro->setDescripcion($descripcion);
            $encuentro->setLugar($lugar);
            $encuentro->setFechaFin(new \DateTime($fecha_fin));
            $encuentro->setFechaInicio(new \DateTime($fecha_inicio));
            $encuentro->setHoraFin($hora_fin);
            $encuentro->setHoraInicio($hora_inicio);
            
            $em->persist($encuentro);
            $em->flush();
  
            $sql = "select update_encuentro_miembro(:id,:enc)";
        
            foreach ($tabla as $value) {                
                $smt = $em->getConnection()->prepare($sql);
                $smt->execute(array(':id'=> $value['id'],':enc'=>$encuentro->getId()));                
            }
            
            $em->commit();
            
            $return=array("responseCode"=>200, "greeting"=>"Ok");
        } catch (Exception $ex) {
            $em->rollback();
            $em->close();
            $em->clear();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        
        return new JsonResponse($return); 
    }
}

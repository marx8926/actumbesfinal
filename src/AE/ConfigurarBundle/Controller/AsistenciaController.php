<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ConfigurarBundle\Controller;

/**
 * Description of AsistenciaController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Asistencia;

class AsistenciaController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEConfigurarBundle:Default:asistencia.html.twig');
    }
    
    public function saveAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            $asistencia = new Asistencia();
            
            $fechaConv_b = $datos['fecha'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
            
            if($datos['red_lista'] != '-1')
                $red = $em->getRepository('AEDataBundle:Red')->find($datos['red_lista']);
            else $red = NULL;
            
            $servicio = $em->getRepository('AEDataBundle:Servicios')->find($datos['servicio']);
            
            $asistencia->setDatAsistenciaFecregistro(new \DateTime());            
            $asistencia->setDatAsistenciaFecasistencia(new \DateTime($fecha));
            $asistencia->setIntAsistenciaCantidad($datos['asistentes']);
            $asistencia->setRed($red);
            $asistencia->setServicio($servicio);
            
            $em->persist($asistencia);
            
            $em->flush();
            
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
    public function editAction()
    {
        
    }
    public function dashboardAction()
    {
        
    }
}

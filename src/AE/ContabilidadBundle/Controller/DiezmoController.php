<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ContabilidadBundle\Controller;

/**
 * Description of DiezmoController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Diezmos;
use AE\DataBundle\Entity\Persona;

class DiezmoController extends Controller {
    //put your code here
     public function viewAction()
    {
        return $this->render('AEContabilidadBundle:Default:diezmo.html.twig');
       //  return $this->render('http://d2dm6eqgiezevm.cloudfront.net/views/diezmo.html.twig');
       
    }
    public function editAction()
    {
        
    }
    public function saveAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            $diezmos = new Diezmos();
            
            $fechaConv_b = $datos['fecha'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
            
            $diezmos->setDatDiezmoFecharegistro(new \DateTime($fecha));
            $diezmos->setDecDiezmoMonto($datos['monto']);
            $diezmos->setVarDiezmoPeticion($datos['peticion']);
            
            $persona = NULL;
            if($datos['persona_id'] != '-1')
                $persona = $em->getRepository('AEDataBundle:Persona')->find($datos['persona_id']);
            
            $diezmos->setPersona($persona);
            
            $em->persist($diezmos);
            
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
    public function infoAction()
    {
        
    }
    
    public function dashboardAction()
    {
        
    }
}

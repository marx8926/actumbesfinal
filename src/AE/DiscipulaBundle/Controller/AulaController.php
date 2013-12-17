<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\DiscipulaBundle\Controller;

/**
 * Description of AulaController
 *
 * @author Marks-Calderon
 */


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Aula;

class AulaController extends Controller {
    //put your code here
    
    public function viewAction()
    {
       return $this->render('AEDiscipulaBundle:Default:aula.html.twig');
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
            
            $fechaConv_b = $datos['fecha'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
            
           
            $aula = new Aula();
          
            $aula->setActivo(TRUE);
            
            $aula->setCreado(new \DateTime($fecha));
            $aula->setNombre($datos['nombre']);
            $aula->setCapacidad($datos['capacidad']);
            
            $em->persist($aula);
            
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
    
    public function deleteAction()
    {
        
        $request = $this->get('request');
        $id =$request->request->get('formulario');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            $aula = $em->getRepository('AEDataBundle:Aula')->find($id);            
            //$curso = new Curso();            
            $aula->setActivo(!$aula->getActivo());
            
            $em->persist($aula);            
            $em->flush();            
            $em->commit();
            
            $return=array("responseCode"=>200, "greeting"=>"Ok");
        } catch (Exception $ex) {
            $em->rollback();
            
            $em->clear();
            $em->close();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        
        return new JsonResponse($return);  
    }
}

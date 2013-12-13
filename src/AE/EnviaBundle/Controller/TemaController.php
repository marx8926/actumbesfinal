<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\EnviaBundle\Controller;

/**
 * Description of TemaController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\TemaCelula;


class TemaController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEEnviaBundle:Default:tema.html.twig');
    }
    
    public function saveAction()
    {
        //aun sin guardar archivo
        
         $request = $this->get('request');
        $datos =$request->request->get('formulario');
        $return = array();
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
           $tema = new TemaCelula();
           $tema->setAutor($datos['author']);
           $tema->setDescripcion($datos['descripcion']);
           $tema->setTitutlo($datos['titulo']);
           $tema->setTipo($datos['tipo']);
           
           $em->persist($tema);
           $em->flush();
            
            $em->commit();
            $em->clear();
            
            $return=array("responseCode"=>200, "greeting"=>"Ok");
        } catch (Exception $ex) {

            $em->rollback();
            $em->clear();
            $em->close();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        
        return new JsonResponse($return);
    }
    
    public function editAction()
    {
        
    }
    
    public function updateAction()
    {
        
    }
}

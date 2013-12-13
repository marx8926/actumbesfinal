<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\DiscipulaBundle\Controller;

/**
 * Description of CursoController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Curso;
use AE\DataBundle\Entity\TemaCurso;

class CursoController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEDiscipulaBundle:Default:curso.html.twig');
    }
    
    public function saveAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');
        $tabla = $request->request->get('tabla');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            $fechaConv_b = $datos['fecha'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
            
            $curso = new Curso();
            
            $curso->setActivo(TRUE);
            $curso->setDescripcion($datos['resumen']);
            $curso->setFechaCreacion(new \DateTime($fecha));
            $curso->setNumeroSesiones(count($tabla));
            $curso->setTitulo($datos['nombre']);
            
            
            
            $em->persist($curso);
            
            $em->flush();
            
            foreach ($tabla as $value) {
                
                $tema = new TemaCurso();
                
                $tema->setActivo(TRUE);
                $tema->setFechaCreacion(new \DateTime());
                $tema->setIdCurso($curso);
                
                $em->persist($tema);
                $em->flush();
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
    
    public function editAction()
    {
        
    }
    
    public function deleteAction()
    {
        
    }
}

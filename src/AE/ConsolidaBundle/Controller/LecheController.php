<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LecheController
 *
 * @author Marks-Calderon
 */
namespace AE\ConsolidaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\LecheEspiritual;
use AE\DataBundle\Entity\TemaLeche;

class LecheController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEConsolidaBundle:Default:leche.html.twig');
    }
    
    public function editAction()
    {
        
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
            
            $leche = new LecheEspiritual();
            $leche->setFechaCreacion(new \DateTime($fecha));
            $leche->setNombre($datos['nombre']);
            $leche->setResumen($datos['resumen']);
            
            $em->persist($leche);
            $em->flush();
            
            foreach ($tabla as $value) {
                
                $tema = new TemaLeche();
                $tema->setIdLecheEspiritual($leche);
                $tema->setTitulo($value['leccion']);
                
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
    
    public function deleteAction()
    {
        
    }
}

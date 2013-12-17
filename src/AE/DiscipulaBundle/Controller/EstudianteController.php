<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\DiscipulaBundle\Controller;

/**
 * Description of EstudianteController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\NivelCrecimiento;

class EstudianteController extends Controller {
    //put your code here
    
       
    public function viewAction()
    {
       return $this->render('AEDiscipulaBundle:Default:estudiante.html.twig');
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
            
            $id = $datos['persona_id'];
            
            $niv = $em->getRepository('AEDataBundle:NivelCrecimiento')->findOneBy(array('persona'=>$id,'intNivelcrecimientoEscala' => 4 ));
            
            if($niv == NULL)
            {
                $persona = $em->getRepository('AEDataBundle:Persona')->find($id);
                
                $nivel = new NivelCrecimiento();
                $nivel->setRed($persona->getRed());
                $nivel->setPersona($persona);
                $nivel->setCreacion(new \DateTime($fecha));
                $nivel->setIntNivelcrecimientoEscala(4);
                $nivel->setIntNivelcrecimientoEstadoactual(1);
                
                $em->persist($nivel);
                $em->flush();
                
            }
            else {
                $niv->setIntNivelcrecimientoEstadoactual(1);
                $em->persist($niv);
                $em->flush();

            }
            $return=array("responseCode"=>200, "greeting"=>"Ok");

            $em->commit();
            
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
            
            $nivel = $em->getRepository('AEDataBundle:NivelCrecimiento')->find($id);            
            //$curso = new Curso();            
            $estado = $nivel->getIntNivelcrecimientoEstadoactual();
            $estado = abs($estado-1);
            
            $nivel->setIntNivelcrecimientoEstadoactual($estado);           
            
            $em->persist($nivel);            
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

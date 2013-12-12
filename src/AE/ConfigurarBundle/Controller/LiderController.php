<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LiderController
 *
 * @author Marks-Calderon
 */
namespace AE\ConfigurarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Lider;
use AE\DataBundle\Entity\NivelCrecimiento;
use AE\DataBundle\Entity\Red;

class LiderController extends Controller {
    //put your code here
    public function viewAction()
    {
        return $this->render('AEConfigurarBundle:Default:lider.html.twig');
    }
    
    public function saveAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            if(array_key_exists('doce', $datos))
            {
                $doce = $datos['doce_lista'];
                $red = $datos['red_lista'];
                
                $net = $em->getRepository('AEDataBundle:Red')->find($red);
                $persona = $em->getRepository('AEDataBundle:Persona')->find($doce);
                //$net = new Red();
                
                //asignamos a la red
                $lider_red = new Lider();
                $lider_red->setIntLider12(1);
                $lider_red->setIntLider144(0);
                $lider_red->setIntLider1728(0);
                $lider_red->setIntLider20736(0);
                
                $fechaConv_b = $datos['creacion'];
            
                $fechaConv_a = explode('/', $fechaConv_b, 3);
            
                $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
                $lider_red->setFecha(new \DateTime($fecha));
                $lider_red->setPastorId($net->getPastor());
                $lider_red->setActivo(TRUE);
                $lider_red->setPersona($persona);
                $lider_red->setDependencia(0);
                
                $em->persist($lider_red);
                $em->flush();
                
                //$net = new Red();
                $net->setLider($persona);
                $em->persist($net);
                $em->flush();
                
                
            }
            elseif (arra_key_exists('ciento',$datos)) {
            
            }
            elseif (arra_key_exists('mil',$datos)) {
                
            }
            elseif (arra_key_exists('ciento',$datos)){
                
            }
            
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
    public function deleteAction()
    {
        
    }
    
}

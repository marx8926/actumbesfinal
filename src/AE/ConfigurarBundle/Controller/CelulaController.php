<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CelulaController
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
use AE\DataBundle\Entity\Red;
use AE\DataBundle\Entity\Celula;
use AE\DataBundle\Entity\Ubicacion;

class CelulaController extends Controller {
    //put your code here
    
    public function viewAction(){
        
        return $this->render('AEConfigurarBundle:Default:celulas.html.twig');
    }
    
    public function editAction(){
        
    }
    
    public function saveAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');
        $return = array();
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            $dis = $datos['distrito_lista'];
            
            $distrito = $em->getRepository('AEDataBundle:Ubigeos')->find($dis);
            
            $ubicacion = new Ubicacion();
            $ubicacion->setDireccion($datos['inputDireccion']);
            $ubicacion->setReferencia($datos['inputReferencia']);
            $ubicacion->setLatitud(0);
            $ubicacion->setLongitud(0);
            $ubicacion->setUbigeo($distrito);                            
            $em->persist($ubicacion);
            $em->flush();
            
            $red = $em->getRepository('AEDataBundle:Red')->find($datos['red_lista']);
            
            $c = new Celula();
            
            $c->setActivo(TRUE);
            $c->setDia($datos['dia']);
            $c->setHora($datos['hora']);
            $c->setFamilia($datos['familia']);
           
            
            $c->setIdRed($red);
            
            $c->setIdUbicacion($ubicacion);
            $c->setTelefono($datos['telefono']);
            $c->setTipo($datos['tipo']);
            
            $fechaConv_b = $datos['creacion'];
            
            $fechaConv_a = explode('/', $fechaConv_b, 3);
            
            $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
            $c->setFechaCreacion(new \DateTime($fecha));
                
            
            if($datos['lider_id'] != '-1')
            {
                $c->setPersona($em->getRepository('AEDataBundle:Persona')->find($datos['lider_id']));
             
            }
           
            $em->persist($c);
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

    
    public function deleteAction(){
        
    }
}

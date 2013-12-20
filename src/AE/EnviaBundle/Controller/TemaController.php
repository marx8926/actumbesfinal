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
use AE\DataBundle\Entity\Celula;
use AE\DataBundle\Entity\AplicacionCelula;
use AE\DataBundle\Entity\AsistenciaCelula;


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
           $tema->setFecha(new \DateTime());
           
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
    
    public function deleteAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');
        $return = array();
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try {
            $id = $datos['tem_id'];
            
            $tema = $em->getRepository('AEDataBundle:TemaCelula')->find($id);
            $file = $tema->getArchivo();
            
            if($file != NULL)
            {
                $em->remove($file);
                $em->flush();
            }
            
            $em->remove($tema);
            $em->flush();
            
            $em->commit();
            $return=array("responseCode"=>200, "greeting"=>"Ok");
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            $em->rollback();
            $em->close();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        
        return new JsonResponse($return);
    }
    
    public function distribuirAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');
        $return = array();
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
          
            $tipo = $datos['tip1_id'];
            $tema = $datos['tema_id'];
            
            $ini = $datos['inicio'];            
            $fechaI= explode('/', $ini, 3);            
            $inicio = $fechaI[2].'-'.$fechaI[1].'-'.$fechaI[0];
            
            $lim = $datos['limite'];
            $fechaL = explode('/', $lim, 3);
            $limite = $fechaL[2].'-'.$fechaL[1].'-'.$fechaL[0];
          
            //recuperar todas las celulas
            $celulas = $em->getRepository('AEDataBundle:Celula')->findBy(array('tipo'=>$tipo,
                'activo'=>TRUE));
            $leccion = $em->getRepository('AEDataBundle:TemaCelula')->find($tema);
            $leccion->setDistribuido(new \DateTime());
            $em->persist($leccion);
            $em->flush();
            
            
            $repo_detalle = $em->getRepository('AEDataBundle:DetalleMiembro');
            //recorremos todas las celulas
            foreach ($celulas as $cell) {                
                
                $appl = new AplicacionCelula();
                $appl->setCelula($cell);
                $appl->setInicio(new \DateTime($inicio));
                $appl->setLimite(new \DateTime($limite));
                $appl->setTemaCelula($leccion);
                $em->persist($appl);
                $em->flush();
                
                $miembros = $repo_detalle->findBy(array('celula'=>$cell->getId()));
                
                //recorremos los miembros de la celula
                
                foreach ($miembros as $m) {
                    $asiste = new AsistenciaCelula();
                    $asiste->setAplicacionCell($appl);
                    $asiste->setPersona($m->getPersona());                    
                    $em->persist($asiste);
                    $em->flush();
                }
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
    
    
}

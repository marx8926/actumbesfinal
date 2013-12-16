<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ConsolidaBundle\Controller;

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
use AE\DataBundle\Entity\ConsolidadoAsistencia;
use AE\DataBundle\Entity\Consolidar;

class AsistenciaController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEConsolidaBundle:Default:asistencia.html.twig');
    }
    
    public function leche_saveAction()
    {
        $request = $this->get('request');
        $datos = $request->request->get('formulario');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            $id = $datos['asistencia_id'];
            $leccion = $datos['leccion'];
            
            $fechaConv_b = $datos['aplicacion'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $aplicacion = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0];
                    
            $asistencia = $em->getRepository('AEDataBundle:ConsolidadoAsistencia')->find($leccion);
            
            //$asistencia = new ConsolidadoAsistencia();            
            $iglesia = FALSE;
            if($datos['iglesia']=='si')
                $iglesia = TRUE;            
            $celula = FALSE;            
            if($datos['celula'] == 'si')
                $celula = TRUE;
            
            $interes = $datos['interes'];
            $detalle = $datos['detalle'];           
            
            $num_leccion = $datos['num_lecciones'];
            
            $asistencia->setCelula($celula);
            $asistencia->setDetalle($detalle);
            $asistencia->setFin(new \DateTime($aplicacion));
            $asistencia->setInteres($interes);
            $asistencia->setDetalle($detalle);
            
            $em->persist($asistencia);
            $em->flush();
            
            $em->commit();
            
            if($num_leccion != '1')
                $return=array("responseCode"=>200, "greeting"=>"Ok");
            else{
                
                //$consolidar = new Consolidar();                
                $consolidar = $em->getRepository('AEDataBundle:Consolidar')->findOneBy(array('consolidado' => $id));
                $consolidar->setFin(new \DateTime($aplicacion));
                $em->persist($consolidar);
                $em->flush();
                $return=array("responseCode"=>300, "greeting"=>"Ok");
            }
        } catch (Exception $ex) {
            $em->rollback();
            $em->close();
            $em->clear();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }        
        return new JsonResponse($return); 
    }
    
    public function leche_descartarAction()
    {
        $request = $this->get('request');
        $id = $request->request->get('formulario');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
           
            $consolidar = $em->getRepository('AEDataBundle:Consolidar')->findOneBy(array('consolidado' => $id));
            
            //$consolidar = new Consolidar();
            $consolidar->setPausa(new \DateTime());
            
            $em->persist($consolidar);
            $em->flush();
            
            
            
            
            $em->commit();
           // $em->clear();
            
           $return=array("responseCode"=>600, "greeting"=>"Ok");
        } catch (Exception $ex) {
            $em->rollback();
            $em->close();
            $em->clear();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }        
        return new JsonResponse($return); 
    }
    
    public function leche_editarAction()
    {
        
        $request = $this->get('request');
        $datos = $request->request->get('formulario');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
           
            $id = $datos['editar_id'];
            $consolidador = $datos['nuevo_consolidador'];
            $consolidador_objeto = $em->getRepository('AEDataBundle:Persona')->find($consolidador);
            
            $consolidar = $em->getRepository('AEDataBundle:Consolidar')->findOneBy(array('consolidado' => $id));
            
            //$consolidar = new Consolidar();
            
            $consolidar->setPausa(new \DateTime());
            $consolidar->setConsolidador($consolidador_objeto);
            
            $em->persist($consolidar);
            $em->flush();
            
            //actualizar detalle miembro
            
            $detalle = $em->getRepository('AEDataBundle:DetalleMiembro')->findOneBy(array('personaId'=>$id));
            
            $detalle->setConsolidadorId($consolidador);
            
            $em->persist($detalle);
            $em->flush();
            
    
            $em->commit();
           // $em->clear();
            
           $return=array("responseCode"=>200, "greeting"=>"Ok");
        } catch (Exception $ex) {
            $em->rollback();
            $em->close();
            $em->clear();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }        
        return new JsonResponse($return); 
    }
    
    public function leche_descartar_editarAction()
    {
        $request = $this->get('request');
        $datos = $request->request->get('formulario');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
           
            $inicio = new \DateTime();
            $id = $datos['editar_descartar_id'];
            $consolidador = $datos['nuevo_consolidador_d'];
            $consolidador_objeto = $em->getRepository('AEDataBundle:Persona')->find($consolidador);
            
            $consolidar = $em->getRepository('AEDataBundle:Consolidar')->findOneBy(array('consolidado' => $id));
            
            //$consolidar = new Consolidar();
            
            $consolidar->setPausa(NULL);
            $consolidar->setConsolidador($consolidador_objeto);
            
            
            
            //actualizar detalle miembro
            
            $detalle = $em->getRepository('AEDataBundle:DetalleMiembro')->findOneBy(array('personaId'=>$id));
            
            $detalle->setConsolidadorId($consolidador);
            
            $em->persist($detalle);
            $em->flush();
            
            //si reinicia las clases
            if($datos['reiniciar'] == 'si')
            {
                $asistencias = $em->getRepository('AEDataBundle:ConsolidadoAsistencia')->findBy(array('consolidar'=> $consolidar->getIntConsolidarId()));
                
                $ini = $inicio;
                foreach ($asistencias as $item) {
                    
                    $item->setInicio($inicio);
                    $item->setPausa(NULL);
                    $item->setFin(NULL);
                    
                    $inicio = $inicio->add(new \DateInterval('P7D'));
                    
                    $em->persist($item);
                    $em->flush();
                }
                
                $consolidar->setInicio(new \DateTime());
                
            }
            
            $em->persist($consolidar);
            $em->flush();
            
            $em->commit();
           // $em->clear();
            
           $return=array("responseCode"=>700, "greeting"=>"Ok");
        } catch (Exception $ex) {
            $em->rollback();
            $em->close();
            $em->clear();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }        
        return new JsonResponse($return); 
    }
}

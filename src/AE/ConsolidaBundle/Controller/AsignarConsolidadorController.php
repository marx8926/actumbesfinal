<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ConsolidaBundle\Controller;

/**
 * Description of AsignarConsolidadorController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\LecheEspiritual;
use AE\DataBundle\Entity\TemaLeche;
use AE\DataBundle\Entity\NivelCrecimiento;
use AE\DataBundle\Entity\Consolidar;
use AE\DataBundle\Entity\ConsolidadoAsistencia;
use AE\DataBundle\Entity\DetalleMiembro;

class AsignarConsolidadorController extends Controller {
    //put your code here
    public function viewAction()
    {
        return $this->render('AEConsolidaBundle:Default:asignarconsolidador.html.twig');
    }
    
    public function saveAction()
    {
         $request = $this->get('request');
        $datos =$request->request->get('formulario');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
       
            $id = $datos['persona_id'];
            //$niv = $em->getRepository('AEDataBundle:NivelCrecimiento')->findOneBy(array('persona'=>$id,'intNivelcrecimientoEscala' => 4 ));
            
            $niv = NULL;
            
            $leche = $datos['leche'];
            $consolidador_id = $datos['consolidadores'];
            
            $fechaConv_b = $datos['inicio'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0];
            
            $repo_persona = $em->getRepository('AEDataBundle:Persona');
            
            $persona = $repo_persona->find($id);
            $consolidador = $repo_persona->find($consolidador_id);
            
            
            //añadimos fila a consolidar
            $consolidar = new Consolidar();
            $consolidar->setConsolidado($persona);
            $consolidar->setConsolidador($consolidador);
            $consolidar->setInicio(new \DateTime($fecha));
            
            
            
            $em->persist($consolidar);
            $em->flush();
            
            
            //actualizamos detalle de miembro
            
            $detalle = $em->getRepository('AEDataBundle:DetalleMiembro')->findOneBy(array('personaId'=>$id));
            
            $detalle->setConsolidadorId($consolidador_id);
            
            $em->persist($detalle);
            $em->flush();
            
            //buscamos la leche espiritual
            
            
            $temas = $em->getRepository('AEDataBundle:TemaLeche')->findBy(array('idLecheEspiritual'=>$leche));
            
            $inicio = new \DateTime($fecha);
            
            foreach ($temas as $clase) {
                
                $asistencia_clase = new ConsolidadoAsistencia();
                $asistencia_clase->setInicio($inicio);
                $asistencia_clase->setTemaLeche($clase);
                $asistencia_clase->setConsolidar($consolidar);
                
                $inicio = $inicio->add(new \DateInterval('P7D'));
                
                $em->persist($asistencia_clase);
                $em->flush();
                
            }
            
            
            $nivel = new NivelCrecimiento();
            $nivel->setRed($persona->getRed());
            $nivel->setPersona($persona);
            $nivel->setCreacion(new \DateTime());
            $nivel->setIntNivelcrecimientoEscala(13);
            $nivel->setIntNivelcrecimientoEstadoactual(1);
                
            $em->persist($nivel);
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
    
    
    public function offAction()
    {
        $request = $this->get('request');
        $id =$request->request->get('formulario');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
       
            //$consolidado = $em->getRepository('AEDataBundle:Consolidar')->findBy(array('consolidado'));
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
}

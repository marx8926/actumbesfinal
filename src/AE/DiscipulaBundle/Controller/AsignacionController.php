<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\DiscipulaBundle\Controller;

/**
 * Description of AsignacionController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\DetallePca;
use AE\DataBundle\Entity\SesionPca;

class AsignacionController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEDiscipulaBundle:Default:asignacion.html.twig');
    }
    
    public function saveAction()
    {
        
        $request = $this->get('request');
        $datos =$request->request->get('formulario');        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            $profesor = $em->getRepository('AEDataBundle:Persona')->find($datos['profesor']);
            $curso = $em->getRepository('AEDataBundle:Curso')->find($datos['curso']);
            $aula = $em->getRepository('AEDataBundle:Aula')->find($datos['aula']);
            
            $fecha_inicio = $datos['inicio'];            
            $fechaini = explode('/', $fecha_inicio, 3);            
            $inicio = $fechaini[2].'-'.$fechaini[1].'-'.$fechaini[0]; 
            
            $fecha_fin = $datos['fin'];            
            $fechafin = explode('/', $fecha_fin, 3);            
            $fin = $fechafin[2].'-'.$fechafin[1].'-'.$fechafin[0];
            
            
            $det = new DetallePca();
            $det->setProfesor($profesor);
            $det->setAula($aula);
            $det->setCurso($curso);
            $det->setDia($datos['dia']);
            $det->setEstado(0);
            $det->setFechaFin(new \DateTime($fin));
            $det->setFechaInicio(new \DateTime($inicio));
            
            $det->setHoraFin($datos['hora_fin']);
            $det->setHoraInicio($datos['hora_inicio']);
            
            $em->persist($det);
            $em->flush();
            
            //recuperar lecciones
            $lecciones = $em->getRepository('AEDataBundle:TemaCurso')->findBy(array('idCurso'=>$datos['curso']));
            
            $inicio = new \DateTime();
            
            foreach ($lecciones as $leccion) {
                $sesion = new SesionPca();
                
                $sesion->setOfrenda(0);
                $sesion->setTemacurso($leccion);
                $sesion->setDetallePca($det);
                $sesion->setInicio($inicio);
                        
                $inicio = $inicio->add(new \DateInterval('P7D'));
                
                $em->persist($sesion);
                $em->flush();
            }
            
            $em->commit();
            
            $return=array("responseCode"=>200, "greeting"=>"Ok");

        } catch (Exception $ex) {
            $em->rollback();
            $em->clear();
            $em->close();
            $return=array("responseCode"=>400, "greeting"=>"Bad");
        }
          
        return new JsonResponse($return);
    }
    public function deleteAction()
    {
        
    }
}

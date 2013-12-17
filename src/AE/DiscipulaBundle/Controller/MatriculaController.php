<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\DiscipulaBundle\Controller;

/**
 * Description of MatriculaController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Matricula;
use AE\DataBundle\Entity\Persona;
use AE\DataBundle\Entity\DetallePca;
use AE\DataBundle\Entity\AsistenciaLeccionCurso;

class MatriculaController extends Controller {
    //put your code here
        
    public function viewAction()
    {
       return $this->render('AEDiscipulaBundle:Default:matricula.html.twig');
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
            
            $id = $datos['matricular_id'];
            $detalle = $em->getRepository('AEDataBundle:DetallePCA')->find($id);
            
            $detalle->setEstado(1);
            $em->persist($detalle);
            $em->flush();
            
            //recuperar las lecciones del curso
            
            $temas = $em->getRepository('AEDataBundle:TemaCurso')->findBy(array('idCurso'=> $detalle->getCurso()->getId()));
            
            //iniciar la matricula
            $per = $datos['matricular'];
            if(count($per)==1)
            {
                $personas = array();
                $personas[] = $per;
            }
            else {
                $personas = $per;
            }
            
            $matriculados = $request->request->get('matriculados');
            $total = array();
            foreach($matriculados as $mat)
            {
                $total[] = $mat['id'];
            }
            
            //sacamos la diferencia de los no matriculados
            $registrar = array_diff($personas, $total);
            
            foreach ($registrar as $value) {
                $estudiante = $em->getRepository('AEDataBundle:Persona')->find($value);
                
                $matricula = new Matricula();
                
                $matricula->setDetallePca($detalle);
                $matricula->setEstado(TRUE);
                $matricula->setEstudiante($estudiante);
                $matricula->setFechaInicio(new \DateTime());
                
                $em->persist($matricula);
                $em->flush();
                
                foreach ($temas as $tema)
                {
                    $asistencia = new AsistenciaLeccionCurso();
                    $asistencia->setLeccion($tema);
                    $asistencia->setAsistencia(FALSE);
                    $asistencia->setMatricula($matricula);
                    $asistencia->setNota(0);
                    
                    $em->persist($asistencia);
                    $em->flush();
                }
                
                //ahora en las lecciones que tiene
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

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
use AE\DataBundle\Entity\Ofrendas;

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
            
            $matri = $request->request->get('matriculados');
            $total = array();
            $matriculados = array();
            if(count($matri)!=0)
            {
                $matriculados[] = $matri;
                foreach($matriculados as $mat)
                {
                    $total[] = $mat['id'];
                }
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
        $em->clear();
        return new JsonResponse($return);
        
    }
    
    public function asistenciaAction()
    {
        
        $request = $this->get('request');
        $datos = $request->request->get('formulario'); 
        $tabla = $request->request->get('matriculados');
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
         
            $fechaConv_b = $datos['aplicacion'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
            
            $id = $datos['asistencia_id'];
            $sesion = $em->getRepository('AEDataBundle:SesionPca')->findOneBy(array('detallePca'=>$id));
            //$sesion = new \AE\DataBundle\Entity\SesionPca();
            
            $sesion->setAplicacion(new \DateTime($fecha));
            $sesion->setOfrenda($datos['ofrenda']);
            
            $em->persist($sesion);
            $em->flush();
            
            //guardando en la tabla ofrenda
            
            $ofrenda = new Ofrendas();
            
            $ofrenda->setDecOfrendaFecharegistro(new \DateTime($fecha));
            $ofrenda->setSesionPca($sesion);
            $ofrenda->setDecOfrendaMonto($datos['ofrenda']);
            $em->persist($ofrenda);
            $em->flush();
            
            //si es la asistencia de la última lección
            if($datos['num_leccion'] == '1')
            {
                //actualizar detalle pca
                $detalle = $em->getRepository('AEDataBundle:DetallePca')->find($id);
                //$detalle = new \AE\DataBundle\Entity\DetallePca();
                //$detalle->setFechaFin(new \DateTime($fecha));
                $detalle->setEstado(2);
                $em->persist($detalle);
                $em->flush();
            }
            else{
                
            }
            
            foreach ($tabla as $item) {
                
                
                $sql = "SELECT update_asistencia_leccion_curso(:mat_id,:leccion,:note,:asist,:apli)";
                $smt = $em->getConnection()->prepare($sql);
                $smt->execute(array(':mat_id' => $item['id_det'], ':leccion' => $datos['leccion'] ,
                    ':note' => $item['nota_val'], ':asist'=> $item['asistencia_val'], ':apli'=>$fecha));
                
                if($datos['num_leccion'] == '1')
                {
                    $sql2 = "select update_fin_matricula_curso(:mat, :apli)";
                    $smt2 = $em->getConnection()->prepare($sql2);
                    $smt2->execute(array(':mat'=>$item['id_det'], ':apli'=>$fecha));
                }
                
            }
            $em->commit();
            
            $return=array("responseCode"=>200, "greeting"=>"Ok");
        } catch (Exception $ex) {
            $em->rollback();
            $em->close();
            $em->clear();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        $em->clear();
        return new JsonResponse($return);
        
    }

    public function terminarAction()
    {
         $request = $this->get('request');
        $datos = $request->request->get('formulario'); 
        $tabla = $request->request->get('terminados');
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
       
            $id = $datos['terminar_id'];
           
         
            //si es la asistencia de la última lección
           
                //actualizar detalle pca
             $detalle = $em->getRepository('AEDataBundle:DetallePca')->find($id);
                //$detalle = new \AE\DataBundle\Entity\DetallePca();
             $detalle->setEstado(3);
             $em->persist($detalle);
             $em->flush();
            
            foreach ($tabla as $item) {
                
                if($item['asistencia_val']== TRUE)
                {
                     $sql2 = "UPDATE matricula SET  aprobado= true WHERE  id =:idx";
                    $smt2 = $em->getConnection()->prepare($sql2);
                    $smt2->execute(array(':idx'=>$item['id_det']));
                }
              
                
            }
            $em->commit();
            
            $return=array("responseCode"=>200, "greeting"=>"Ok");
        } catch (Exception $ex) {
            $em->rollback();
            $em->close();
            $em->clear();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        $em->clear();
        return new JsonResponse($return);
    }
    
}

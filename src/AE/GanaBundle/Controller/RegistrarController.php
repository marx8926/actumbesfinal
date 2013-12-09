<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistrarController
 *
 * @author Marks-Calderon
 */

namespace AE\GanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AE\DataBundle\Entity\Persona;
use AE\DataBundle\Entity\Ubicacion;
use AE\DataBundle\Entity\Ubigeos;

class RegistrarController  extends Controller {
    
    public function registrar_personaAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');
        
        if($datos != null)
        {
            $em = $this->getDoctrine()->getManager();
            $em->beginTransaction();
            
            try
            {
                $email = $datos['inputEmail'];
                $nombres = $datos['inputNombres'];
                $apellidos = $datos['inputApellidos'];            
                $civil = $datos['select_Civil'];
                $sexo = $datos['select_Sexo'];            
                $fech_b = $datos['inputFechaNacimiento'];
            
                $fech_a =explode('/', $fech_b,3);
                $fech = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0];
            
            
                $edad = $datos['inputEdad'];
            
                $telefono = $datos['inputTelefono'];
                $celular = $datos['inputCelular'];
            
                $direccion = $datos['inputDireccion'];
                $referencia = $datos['inputReferencia'];
            
                $distrito = $datos['distrito_lista'];
                
                $red = $datos['red_lista'];
                if(strcmp($red, '-1')!=0)
                $celula = '';
            
                $fechaConv_b = $datos['inputFechaConversion'];
            
                $fechaConv_a = explode('/', $fechaConv_b, 3);
            
                $fechaConv = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0];            
            
                $lugar = $datos['lugar'];
          
            
                $peticion = $datos['inputDescripcion'];            
            
                $dni = $datos['inputDni'];
                $ocupacion = $datos['inputOcupacion'];
            
                $dia = $datos['dia_lista'];
                $hora = $datos['inputHora'];     
                
                $prev_div = $em->getRepository('AEDataBundle:Ubigeos');
                $ubigeo = $prev_div->findOneBy(array('intUbigeoId'=>$distrito));
                
                  //ubicacion
                $ubicacion = new Ubicacion();
                $ubicacion->setDireccion($direccion);
                $ubicacion->setReferencia($referencia);
                $ubicacion->setLatitud(0);
                $ubicacion->setLongitud(0);
                $ubicacion->setUbigeo($ubigeo);
                            
                $em->persist($ubicacion);
                $em->flush();
                
                //persona           
                
                $persona = new Persona();
                $persona->setApellidos($apellidos);
                $persona->setNombre($nombres);
                $persona->setCelular($celular);
                $persona->setTelefono($telefono);
                $persona->setEstadoCivil($civil);
                $persona->setEdad($edad);
                $persona->setFechaNacimiento(new \DateTime($fech));
                $persona->setSexo($sexo);
                $persona->setIdUbicacion($ubicacion);
                $persona->setDni($dni);
                $persona->setOcupacion($ocupacion);
                $persona->setEmail($email);
                
                //lugar                  
                $con1 = $em->getRepository('AEDataBundle:Lugar');          
                $lug= $con1->findOneBy(array('intLugarId'=>$lugar));
                $persona->setLugar($lug);
                
                if(strcmp($red, '-1')!=0)
                {
                    //red
                    $con2 = $em->getRepository('AEDataBundle:Red');
                    $redU = $con2->findOneBy(array('intRedId'=>$red));
                
                    //celula
                    if(strcmp($celula, '-1')!=0)
                    {
                        //$con3 = $em->getRepository('AEDataBundle:Celula');
                        //$cell = $con3->findOneBy(array('id'=>$celula));
                
                        //$nuev_con->setIdCelula($cell);
                    }
                    //$nuev_con->setIdRed($redU);
                    
                    $persona->setRed($redU);
                }
                
                $em->persist($persona);
                $em->flush();
                
                
                $return=array("responseCode"=>200,  "greeting"=>'ok');
                
                $em->commit();
            } catch (Exception $ex) {

                $em->rollback();
                $em->clear();
                $em->close();
                
                $return=array("responseCode"=>400, "greeting"=>"Bad");
            }
            
        }
         
        else
        {
           $return=array("responseCode"=>400, "greeting"=>"Bad");
           
        }
        $resultado= new JsonResponse($return);
        
        return $resultado;
    }
    
    public function testAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $p = new Persona();
        $p->setNombre("");
        $p->setApellidos("");
        $p->setEstadoCivil(0);
        $p->setEdad(12);
        $p->setFechaNacimiento(new \DateTime('2012-12-12'));
        $p->setSexo(1);
        
        $em->persist($p);
        
       
         $prev_div = $em->getRepository('AEDataBundle:Ubigeos');
                $ubigeo = $prev_div->findOneBy(array('intUbigeoId'=>2));
                
                  //ubicacion
                $direccion="";
                $referencia="";
                $ubicacion = new Ubicacion();
                $ubicacion->setDireccion($direccion);
                $ubicacion->setReferencia($referencia);
                $ubicacion->setLatitud(0);
                $ubicacion->setLongitud(0);
                $ubicacion->setUbigeo($ubigeo);
                            
                $em->persist($ubicacion);
                $em->flush();
                
        $em->flush();
        $return=array("responseCode"=>400, "greeting"=>"Bad");
        
        return new JsonResponse($return);
    }
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditarController
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
use AE\DataBundle\Entity\NivelCrecimiento;
use AE\DataBundle\Entity\DetalleMiembro;


class EditarController extends Controller {
    //put your code here
    
    public function viewAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $repo = $em->getRepository('AEDataBundle:Persona');
        $persona = $repo->find($id);
        
        $gan = NULL;
        
        if($persona->getGanadoPor() != NULL)
        {
            $ganado = $repo->find($persona->getGanadoPor());
            $gan = $ganado->getNombre()." ".$ganado->getApellidos();
        }
        else $gan = "";
        
        $distrito= $persona->getIdUbicacion()->getUbigeo();
        
        $detalle = $em->getRepository('AEDataBundle:DetalleMiembro')->findOneBy(array('persona'=>$id));
            
        $prev_ubi = $em->getRepository('AEDataBundle:Ubigeos');
        $provincia = $prev_ubi->findOneBy(array('intUbigeoId'=>$distrito->getIntUbigeoDependencia()));
        
        
        $red = $persona->getRed();
        if($red != NULL)
        {
            $red = $red->getIntRedId();
        }
            
            
        $departamento = $prev_ubi->findOneBy(array('intUbigeoId'=>$provincia->getIntUbigeoDependencia()));
        
        return $this->render('AEGanaBundle:Default:editar.html.twig',array('persona'=>$persona,
            'distrito'=> $distrito, 'provincia'=>$provincia, 'departamento'=>$departamento, 'ganado' => $gan,
            'detalle'=> $detalle,'red'=>$red));
        
    }
    
    public function saveAction()
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
            
                $fechaConv_b = $datos['inputFechaConversion'];            
                $fechaConv_a = explode('/', $fechaConv_b, 3);
            
                $fechaConv = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0];            
            
                $lugar = $datos['lugar'];       
            
                $peticion = $datos['inputDescripcion'];            
            
                $dni = $datos['inputDni'];
                $ocupacion = $datos['inputOcupacion'];
            
                $dia = $datos['dia_lista'];
                $hora = $datos['inputHora'];     
                
                $ganado = $datos['ganador_id'];
                if($ganado == '-1')
                {
                    $ganado = NULL;
                }
                
                
                $prev_div = $em->getRepository('AEDataBundle:Ubigeos');
                $ubigeo = $prev_div->findOneBy(array('intUbigeoId'=>$distrito));
                
                $id = $datos['id_persona'];
                $persona = $em->getRepository('AEDataBundle:Persona')->find($id);
                  //ubicacion
                $ubicacion = $persona->getIdUbicacion();
                
                $ubicacion->setDireccion($direccion);
                $ubicacion->setReferencia($referencia);
                $ubicacion->setLatitud(0);
                $ubicacion->setLongitud(0);
                $ubicacion->setUbigeo($ubigeo);                            
                $em->persist($ubicacion);
                $em->flush();
                
                
                //guardar detalle miembro
                
                $det = $em->getRepository('AEDataBundle:DetalleMiembro')->findOneBy(array('persona'=>$id));
                
                //persona           
                
                $persona->setApellidos($apellidos);
                $persona->setNombre($nombres);
                $persona->setDia($dia);
                $persona->setHora($hora);
                $persona->setCelular($celular);
                $persona->setTelefono($telefono);
                $persona->setEstadoCivil($civil);
                $persona->setEdad($edad);
                $persona->setFechaNacimiento(new \DateTime($fech));
                $persona->setSexo($sexo);
                $persona->setIdUbicacion($ubicacion);
                
                if(strlen($ganado)>0)
                {
                    $persona->setGanadoPor($ganado);
                    $det->setGanadoPor($ganado);
                }
                
                $persona->setDni($dni);
                $persona->setOcupacion($ocupacion);
                $persona->setEmail($email);
                $persona->setPeticion($peticion);
                
                //lugar                  
                $con1 = $em->getRepository('AEDataBundle:Lugar');          
                $lug= $con1->findOneBy(array('intLugarId'=>$lugar));
                $persona->setLugar($lug);
                
                $redU = NULL;
                
                if(strcmp($red, '-1')!=0)
                {
                    //red
                    $con2 = $em->getRepository('AEDataBundle:Red');
                    $redU = $con2->findOneBy(array('intRedId'=>$red));
     
                }
                
                $persona->setRed($redU); 
                $persona->setActivo(true);
                $em->persist($persona);
                $em->flush();
                
                $niveles = $em->getRepository('AEDataBundle:NivelCrecimiento')->findBy(array('persona'=>$id));
               
                foreach ($niveles as $nivel) {
                    
                    $nivel->setIntNivelcrecimientoEscala(0);
                    $nivel->setIntNivelcrecimientoEstadoactual(1);
                    $nivel->setRed($redU);
                    $nivel->setPersona($persona);
                    $nivel->setCreacion(new \DateTime($fechaConv));
                
                
                    $em->persist($nivel);
                    $em->flush();
                }
                
                
                
                $det->setActivo(TRUE);
                $det->setRed($redU);
                $det->setPersona($persona);
                $det->setConvertido(new \DateTime($fechaConv));
                
                
                $em->persist($det);
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
    
}

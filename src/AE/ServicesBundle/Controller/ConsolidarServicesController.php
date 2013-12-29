<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ServicesBundle\Controller;

/**
 * Description of ConsolidarController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConsolidarServicesController extends Controller {
    //put your code here
    
    public function lista_consolidador_initAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_consolidador_init";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_consolidador_allAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_consolidador_all";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_consolidador_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();
       
        $securityContext = $this->get('security.context');
        
        $result = array();
        
       if($securityContext->isGranted('ROLE_CONSOLIDAR') || $securityContext->isGranted('ROLE_LIDER_RED'))
       {
        $sql = "select * from get_consolidador_red_option(:red)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();
       }
       elseif($securityContext->isGranted('ROLE_CONSOLIDADOR')) {
           $persona = $securityContext->getToken()->getUser()->getIdPersona();
            $result = array();
            $nombres = $persona->getNombre()." ".$persona->getApellidos();
            $id = $persona->getId();
            if($red != NULL)
                $result[] = array("id" => $id, "nombres"=>$nombres);
        }
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_miembro_init_no_consolidadorAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_miembros_no_consolidador_init";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_miembro_all_no_consolidadorAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from view_get_miembros_noconsolidador_all";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
    
    public function lista_miembro_red_no_consolidadorAction($red)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_miembro_red_noconsolidador(:red)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }
   
    public function lista_sin_consolidar_redAction($red)
    {
      $em = $this->getDoctrine()->getManager();
        
        $sql = "SELECT * from get_miembro_red_no_escala(:red,:escala,:estado)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':escala'=>13,':estado'=>1));
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }

    public function lista_consolidando_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_miembros_consolidando_red(:red)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse(array('aaData' =>$result));
        return $resultado;
    }

    public function lista_lecheAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "SELECT id, nombre  FROM leche_espiritual order by nombre asc";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();
        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
       
        return $resultado;
    }
    
    private function asistencia_consolidados($array)
    {
        $em = $this->getDoctrine()->getManager();
        
        $tabla = array();
        foreach ($array as $row) {
            $sql="select * from get_asistencia_por_consolidado(:id)";
            $smt = $em->getConnection()->prepare($sql);
            $smt->execute(array(':id'=>$row['id']));
            
            $asistencias = $smt->fetchAll();
            
            $fila = $row;
            $j = 1;
            foreach ($asistencias as $i) {
                if($i['fin'] != NULL)
                {
                    $fila['L'.strval($j)] = '&#10004<br>'.$i['fin'];
                }
                else {
                    $fila['L'.strval($j)] = '';

                }
                
                $j++;
            }
            $tabla[]=$fila;
                        
        }
        return $tabla;
    }
    
    public function lista_consolidando_red_consolidadorAction($red , $consolidador)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_miembros_consolidando_red_xconsolidador(:red,:consolidador)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':consolidador' => $consolidador));
        $result = $smt->fetchAll();
        
        $final = $this->asistencia_consolidados($result);
                
        $resultado= new JsonResponse(array('aaData' =>$final));
        return $resultado;
        
    }
    
    public function lista_consolidando_red_consolidador_fechaAction($red , $consolidador, $inicio, $fin)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_miembros_consolidando_red_xconsolidador_fecha(:red,:consolidador, :ini, :fin)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':consolidador' => $consolidador, ':ini' => $inicio, ':fin' => $fin));
        $result = $smt->fetchAll();
        
         $final = $this->asistencia_consolidados($result);
                
        $resultado= new JsonResponse(array('aaData' =>$final));
        return $resultado;
        
    }
    
    public function lista_consolidado_red_consolidadorAction($red , $consolidador)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_miembros_consolidado_red_xconsolidador(:red,:consolidador)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':consolidador' => $consolidador));
        $result = $smt->fetchAll();
        
        $final = $this->asistencia_consolidados($result);
                
        $resultado= new JsonResponse(array('aaData' =>$final));
        return $resultado;
    }
    
    public function lista_consolidado_red_consolidador_fechaAction($red , $consolidador, $inicio, $fin)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_miembros_consolidado_red_xconsolidador_fecha(:red,:consolidador,:ini,:fin)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':consolidador' => $consolidador, ':ini'=>$inicio, ':fin' => $fin));
        $result = $smt->fetchAll();
        
        $final = $this->asistencia_consolidados($result);
                
        $resultado= new JsonResponse(array('aaData' =>$final));
        return $resultado;
    }
    
    public function lista_descartar_red_consolidadorAction($red , $consolidador)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_miembros_descartado_red_xconsolidador(:red,:consolidador)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':consolidador' => $consolidador));
        $result = $smt->fetchAll();
        
        $final = $this->asistencia_consolidados($result);
                
        $resultado= new JsonResponse(array('aaData' =>$final));
        return $resultado;
    }
    
    public function lista_descartar_red_consolidador_fechaAction($red , $consolidador,$inicio, $fin)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sql = "select * from get_miembros_descartado_red_xconsolidador_fecha(:red,:consolidador, :ini,:fin)";
        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':consolidador' => $consolidador, ':ini'=>$inicio, ':fin'=>$fin));
        $result = $smt->fetchAll();
        
        $final = $this->asistencia_consolidados($result);
                
        $resultado= new JsonResponse(array('aaData' =>$final));
        return $resultado;
    }
    
    public function temas_leche_consolidadoAction($consolidado)
    {        
        
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_tema_por_consolidado(:consolidado)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':consolidado' => $consolidado));
        $result = $smt->fetchAll();        
        return new JsonResponse($result);
    }
    
    public function temas_leche_tablaAction()
    {
        $em = $this->getDoctrine()->getManager();     
        
        $sql = "SELECT *  FROM view_get_leche";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $leches = $smt->fetchAll();
        
        $matriz = array();
        
        foreach ($leches as $item) {
         
            //consultamos los temas de cada tema
            
            $sql2 = "select * from get_temas_leche(:id)";
            $smt2 = $em->getConnection()->prepare($sql2);
            $smt2->execute(array(':id'=>$item['id']));
            $temas = $smt2->fetchAll();
            
            $fila = $item;
            
            $lecciones = "";
            //recorremos los temas
            foreach($temas as $i) {
                $lecciones = $lecciones.$i['titulo']."<br>";
            }
            $fila['lecciones'] = $lecciones;
            $fila['acciones'] = "";
            $matriz[] = $fila;
        }
             
        return new JsonResponse(array('aaData'=>$matriz));
    }
}

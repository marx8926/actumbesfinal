<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ServicesBundle\Controller;

/**
 * Description of DiscipularServices
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DiscipularServicesController extends Controller {
    //put your code here
    
    public function miembros_nodocente_autocomplete_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_miembros_no_nivel_red(:red,:nivel,:inicio)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red' => $red, ':nivel' => 5,':inicio'=>0));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();       
        return $resultado;
    }
    
    public function persona_noestudiante_autocomplete_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_sin_nivel_red(:red,:nivel)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red' => $red, ':nivel' => '4'));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();       
        return $resultado;
    }
    
    public function cursos_option_allAction()
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "SELECT id, titulo   FROM curso where activo=true order by titulo asc";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $cursos = $smt->fetchAll();
        
        $result = [];
        $item = array("id" => -1, "titulo"=>"Ninguno");
        
        array_push($result,$item);
        
        foreach ($cursos as $value) {
          array_push($result, $value);  
        }
        
        $resultado= new JsonResponse($result);      
        return $resultado;
    }
    
    public function cursos_all_tableAction()
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "SELECT * FROM view_get_cursos_all";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $cursos = $smt->fetchAll();
        
        $result = array();
        
        foreach ($cursos as $c) {
            
            $item = array();
            $item['id'] = $c['id'];
            $item['abreviatura'] = $c['abreviatura'];
            $item['titulo'] = $c['titulo'];
            $item['resumen'] = $c['descripcion'];
            
            $sql2 = "select * from tema_curso where id_curso =:idc ";
            $smt2 = $em->getConnection()->prepare($sql2);
            $smt2->execute(array(':idc'=>$c['id']));
            $temas = $smt2->fetchAll();
            
            $lecciones = "";
            
            foreach ($temas as $value) {
                $lecciones = $lecciones."<br>".$value['abreviatura'].": ".$value['titulo'];
            }
            $item['lecciones'] = $lecciones;
            
            //requisito
            
            $item['requisito'] = $c['requisito'];
            $item['activo'] = $c['activo'];
            if($item['activo'] == TRUE)
                $item['estado']='Activo';
            else
                $item['estado']='Desactivo';
            
            $item['acciones'] = "";
            
            $result[] = $item;
        }
        $resultado= new JsonResponse(array('aaData'=>$result));      
        return $resultado;
    }
    
    public function profesor_all_tableAction()
    {
        
        $em = $this->getDoctrine()->getManager(); 
        $sql = "SELECT * FROM view_get_profesores_all";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();       
        
        $resultado= new JsonResponse(array('aaData'=>$result));      
        return $resultado;
        
    }
            
    public function estudiante_red_tableAction($red)
    {
        $em = $this->getDoctrine()->getManager(); 
        $sql = "SELECT * FROM get_niveles_all_tabla_red(:red,:nivel)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':nivel' => 4));
        $result = $smt->fetchAll();       
        
        $resultado= new JsonResponse(array('aaData'=>$result));      
        return $resultado;
    }
    
     public function estudiante_activo_red_tableAction($red)
    {
        $em = $this->getDoctrine()->getManager(); 
        $sql = "SELECT * FROM get_niveles_all_tabla_red(:red,:nivel,:estado)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':nivel' => 4, ':estado' => 1));
        $result = $smt->fetchAll();       
        
        $resultado= new JsonResponse(array('aaData'=>$result));      
        return $resultado;
    }
    
    public function aula_all_tableAction()
    {
        $em = $this->getDoctrine()->getManager(); 
        $sql = "SELECT * FROM view_get_all_aulas";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();       
        
        $resultado= new JsonResponse(array('aaData'=>$result));      
        return $resultado;
    }
    
    public function profesor_optionAction()
    {
        $em = $this->getDoctrine()->getManager(); 
        $sql = "SELECT * FROM view_get_profesores_all_option";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();       
        
        $resultado= new JsonResponse($result);      
        return $resultado;
    }
    
    public function curso_optionAction()
    {
        $em = $this->getDoctrine()->getManager(); 
        $sql = "SELECT * FROM view_get_curso_all_option";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();       
        
        $resultado= new JsonResponse($result);      
        return $resultado;
    }
    
    public function aula_optionAction()
    {
        $em = $this->getDoctrine()->getManager(); 
        $sql = "SELECT * FROM view_get_aula_all_option";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();       
        
        $resultado= new JsonResponse($result);      
        return $resultado;
    }
    
    public function curso_profesor_tablaAction($profesor, $curso)
    {
        
        $em = $this->getDoctrine()->getManager(); 
        $sql = "select * from get_detalle_pca_profesor_curso(:profe,:curso)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':profe'=>$profesor, ':curso'=>$curso));
        $result = $smt->fetchAll();       
        
        $resultado= new JsonResponse(array('aaData'=>$result));      
        return $resultado;
        
    }
    
    public function matriculados_detalleAction($detalle)
    {        
        $em = $this->getDoctrine()->getManager(); 
        $sql = "select * from get_matriculados_detalle(:detalle)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':detalle'=>$detalle));
        $result = $smt->fetchAll();       
        
        $resultado= new JsonResponse($result);      
        return $resultado;
    }
    
    public function table_matriculados_detalleAction($detalle, $num_lecciones)
    {
        //select * from get_asistencia_detalle(1);
        
        $em = $this->getDoctrine()->getManager(); 
        $sql = "select * from get_asistencia_detalle(:detalle)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':detalle'=>$detalle));
        $result = $smt->fetchAll();       
        
        
        $num_total = count($result);
        
        $grupos = $num_total/$num_lecciones;
        
        $resultado = array();
        
        for ($i = 0; $i< $grupos; $i++) {
            
            $item = array();
            $item['nro'] = strval($i+1);
            $item['id'] = $result[$i*$num_lecciones]['id'];
            $item['nombres'] = $result[$i*$num_lecciones]['nombres'];
            
            for($j = 0; $j<$num_lecciones; $j++)
            {
                $patron = "L".strval($j+1);                
                $p = "";
                //asistencia
                if($result[$j+$i*$num_lecciones]['asistencia'])
                    $p = "/<br>";
               else
                   $p = "x<br>";
                //nota                   
                $p = $p.$result[$j+$i*$num_lecciones]['nota'];                
                $item[$patron] = $p;                
            }
            $resultado[] = $item;
        }
        
        
        return  new JsonResponse(array('aaData' =>$resultado));      

    }
    
}

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
}

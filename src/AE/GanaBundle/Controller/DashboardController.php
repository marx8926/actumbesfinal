<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\GanaBundle\Controller;

/**
 * Description of DashboardController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEGanaBundle:Default:dashboard.html.twig');
    }
    
    private function anual_red($ini, $fin, $red)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select * from get_informe_ganados_por_mes_red(:ini,:fin,:net)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':ini'=>$ini,':fin'=>$fin,':net'=>$red));        
        $result = $smt->fetchAll();
        
        return $result;
    }
    private function anual_all($ini, $fin)
    {
        $em = $this->getDoctrine()->getManager();
                
        $sql = "select * from get_informe_ganados_por_mes_all(:ini,:fin)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':ini'=>$ini,':fin'=>$fin));        
        $result = $smt->fetchAll();
        
        return $result;
    }
    
     private function semanal_red($ini, $fin, $red)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select * from get_informe_ganados_por_semana_red(:ini,:fin,:net)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':ini'=>$ini,':fin'=>$fin,':net'=>$red));        
        $result = $smt->fetchAll();
        
        return $result;
    }
    private function semanal_all($ini, $fin)
    {
        $em = $this->getDoctrine()->getManager();
                
        $sql = "select * from get_informe_ganados_por_semana_all(:ini,:fin)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':ini'=>$ini,':fin'=>$fin));        
        $result = $smt->fetchAll();
        
        return $result;
    }
     private function init_fila($n)
    {
        $row = array();
        
        for ($i = 0; $i < $n; $i++) {
            $row[] = 0;
        }
        return $row;
    }
    private function serie_semana($ini, $fin)
    {
        $em = $this->getDoctrine()->getManager();
        $sql = "select * from get_semanas_serie(:ini,:fin)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':ini'=>$ini,':fin'=>$fin));
        
        return $smt->fetchAll();
    }
    public function serviceAction()
    {
        $request = $this->get('request');
        $red =$request->request->get('red_lista');
        $desde = $request->request->get('desde');
        $year = $request->request->get('year');
        $tipo = $request->request->get('tipo');
        
        $titulo = null;
        $subtitulo = null;
        $categorias = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul','Ago','Sep','Oct','Nov','Dic'];
        $ys = null;
        $serie = null;
       
        if($red == '-1')
            return new JsonResponse($tipo);
        else
        {
            $network = $this->getDoctrine()->getRepository('AEDataBundle:Red')->find($red);
            $net = $network->getId();
        }
        
        if($tipo == 'anual')
        {
            $ini = $year.'-01-01';
            $fin = $year.'-12-31';
            
            
          
           if($red == '0')            
           {
               $data = $this->anual_all($ini, $fin);  
               $titulo = "Ganados de todas las redes ".$year;
               $serie = "Todos";
           }
           else
           {
               $data = $this->anual_red ($ini, $fin, $red);
               $titulo = "Ganados ".$net." ".$year;
               $serie = "Red ".$net;

           }
          
           $meses = $this->init_fila(12);                

           if(count($data)> 0){
               foreach ($data as $i)
                       $meses[$i['mes']-1] = intval($i['ganados']);                                        
                }
            
           $data = $meses;
        }
        elseif ($tipo == 'tri') {
            if($desde == '1')
            {
                $ini = $year.'-01-01';
                $fin = $year.'-03-31';
                $titulo = "Ganados de Ene-Mar";
            }
            elseif ($desde == '2') {
                $ini = $year.'-04-01';
                $fin = $year.'-06-30';
                $titulo = "Ganados de Abr-Jun";
            }
            elseif ($desde == '3') {
                $ini = $year.'-07-01';
                $fin = $year.'-09-30';
                $titulo = "Ganados de Jul-Sep";
            }
            else{
                $ini = $year.'-10-01';
                $fin = $year.'-12-31';
                $titulo = "Ganados de Oct-Dic";
            }
            
           if($red == '0')            
           {
               $data = $this->semanal_all ($ini, $fin);
               $titulo = $titulo." todas las redes";
           }
           else
           {
               $data = $this->semanal_red ($ini, $fin, $red);
               $titulo = $titulo." por ".$net;               
           }

           $semana_serie = $this->serie_semana($ini, $fin);
           $n = count($semana_serie);                
           $semanas = $this->init_fila($n);
           
           if(count($data)> 0){
               foreach ($data as $i)
                  $semanas[$i['semana']-$semana_serie[0]['semana']] = intval($i['ganados']);
           }
           
           $categorias = array();           
           foreach ($semana_serie as $s) {
               $categorias[]=$s['fecha'];
           }
           $data = $semanas;
        }
        else
        {
            $fecha = new \DateTime();
            $fecha->setDate( intval($year), intval($desde), 1);
            
            $ini = $fecha->format('Y-m-d');
            
            $fecha->modify('+1 month');
            $fecha->modify('-1 day');

            $fin = $fecha->format('Y-m-d');
              
           if($red == '0')            
           {
               $data = $this->semanal_all ($ini, $fin);
               $titulo = "Ganados de todas las redes ".$year." ".$categorias[intval($desde)-1];               
           }
           else
           {
               $data = $this->semanal_red ($ini, $fin, $red);
               $titulo = "Ganados de la red ".$net." ".$year." ".$categorias[intval($desde)-1];
           }
          
           $semana_serie = $this->serie_semana($ini, $fin);
           $n = count($semana_serie);                
           $semanas = $this->init_fila($n);
           
           if(count($data)> 0){
               foreach ($data as $i)
                  $semanas[$i['semana']-$semana_serie[0]['semana']] = intval($i['ganados']);
           }
           
           $categorias = array();           
           foreach ($semana_serie as $s) {
               $categorias[]=$s['fecha'];
           }
           $data = $semanas;
        }
        
        $result = array('titulo'=>$titulo,
            "subtitulo" => $subtitulo,
            "categorias" => $categorias,
            "y" => "# almas",
            "data" => $data,
            "serie" => $serie);
        return new JsonResponse($result);
    }
}

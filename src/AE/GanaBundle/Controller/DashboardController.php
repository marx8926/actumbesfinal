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
        $sql = "select * from get_informe_ganados_por_mes_red(:ini,:fin,:net)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':ini'=>$ini,':fin'=>$fin,':net'=>$red));        
        $result = $smt->fetchAll();
        
        return $result;
    }
    private function semanal_all($ini, $fin)
    {
        $em = $this->getDoctrine()->getManager();
                
        $sql = "select * from get_informe_ganados_por_mes_all(:ini,:fin)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':ini'=>$ini,':fin'=>$fin));        
        $result = $smt->fetchAll();
        
        return $result;
    }
    public function serviceAction()
    {
        $request = $this->get('request');
        $red =$request->request->get('red_lista');
        $desde = $request->request->get('desde');
        $year = $request->request->get('year');
        $tipo = $request->request->get('tipo');
        
       // $data = array();
        
         if($red == '-1')
            return new JsonResponse($tipo);
        
        if($tipo == 'anual')
        {
            $ini = $year.'-01-01';
            $fin = $year.'-12-31';
           if($red == '0')            
               $data = $this->anual_all($ini, $fin);               
           else
               $data = $this->anual_red ($ini, $fin, $red);              

        }
        elseif ($tipo == 'tri') {
            if($desde == '1')
            {
                $ini = $year.'-01-01';
                $fin = $year.'-03-31';                
            }
            elseif ($desde == '2') {
                $ini = $year.'-04-01';
                $fin = $year.'-06-30';
            }
            elseif ($desde == '3') {
                $ini = $year.'-07-01';
                $fin = $year.'-09-30';
            }
            else{
                $ini = $year.'-10-01';
                $fin = $year.'-12-31';
            }
            
           if($red == '0')            
               $data = $this->semanal_all ($ini, $fin);
           else
               $data = $this->semanal_red ($ini, $fin, $red);
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
               $data = $this->semanal_all ($ini, $fin);
           else
               $data = $this->semanal_red ($ini, $fin, $red);
        }
        
        return new JsonResponse($fin);
    }
}

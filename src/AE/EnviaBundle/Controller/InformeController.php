<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\EnviaBundle\Controller;

/**
 * Description of InformeController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;

class InformeController extends Controller {
    //put your code here
    public function informe_semanal_viewAction()
    {
        return $this->render('AEEnviaBundle:Default:informesemanal.html.twig');
    }
    
    private function get_tabla_semanal_enviar($redes, $inicio, $fin,$tipo)
    {
        $em = $this->getDoctrine()->getManager();
        
        $resultado = array();
        
        foreach ($redes as $value) {
            
            $fila = array();
            $fila['id'] = $value['id'];
            $fila['lider'] = $value['lider'];
            
            $sql = "SELECT * from get_informe_ganar_resumen_por_rango_lider_celula(:net)";
            $smt = $em->getConnection()->prepare($sql);
            $smt->execute(array(':net'=>$value['int_red_id']));
            $fill = $smt->fetch();
            $fila['doce'] = $fill['doce'];
            $fila['cien'] = $fill['cien'];
            $fila['mil'] = $fill['mil'];
            $fila['celulas']=$fill['num_cell'];
            
            $resultado[] = $fila;
           
        }
        
        //asistencias a celulas
         $sql = "SELECT asistencias from get_informe_ganar_resumen_por_rango_asistencia_celula(:tipo,:ini,:fin)";
         $smt1 = $em->getConnection()->prepare($sql);
         $smt1->execute(array(':tipo'=>$tipo,':ini'=>$inicio,':fin'=>$fin));
         $asist_celulas = $smt1->fetchAll();
         
         //asistencia servicio
         
         $sql = "SELECT asistencias from get_informe_ganar_resumen_por_rango_asistencia_servicio(:tipo,:ini,:fin)";
         $smt1 = $em->getConnection()->prepare($sql);
         $smt1->execute(array(':tipo'=>$tipo,':ini'=>$inicio,':fin'=>$fin));
         $asist_servicio = $smt1->fetchAll();
         
         //nuevos convertidos  y celulas
          $sql = "SELECT nuevos, celulas from get_informe_ganar_resumen_por_rango_nuevos_celula(:tipo,:ini,:fin)";
         $smt1 = $em->getConnection()->prepare($sql);
         $smt1->execute(array(':tipo'=>$tipo,':ini'=>$inicio,':fin'=>$fin));
         $convertidos_celulas = $smt1->fetchAll();
         
         //ofrendas
          $sql = "SELECT ofrendas from get_informe_ganar_resumen_por_rango_ofrendas(:tipo,:ini,:fin)";
         $smt1 = $em->getConnection()->prepare($sql);
         $smt1->execute(array(':tipo'=>$tipo,':ini'=>$inicio,':fin'=>$fin));
         $ofrendas = $smt1->fetchAll();
        
        return array('primer'=>$resultado, 'celulas'=>$asist_celulas, 'servicio'=>$asist_servicio,
            'nuevos'=>$convertidos_celulas, 'ofrendas'=>$ofrendas);
    }
    
    public function informe_semanal_serviceAction()
    {
       $request = $this->get('request');
       $tipo =$request->request->get('tipo_red');
        $desde = $request->request->get('desde');
        $hasta = $request->request->get('hasta');
                
        $fech_b = $desde;
       $fech_a =explode('/', $fech_b,3);
       $inicio = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0];  
       
       $fech_b = $hasta;
       $fech_a =explode('/', $fech_b,3);
       $fin = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0];
       
       getcwd();
       chdir('report\enviar');
       $path = getcwd()."\informe_semanal_celulas.xls";
       
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($path);

       $sql = "select * from get_redes_con_lider_activas_tipo(:tipo)";
       $em = $this->getDoctrine()->getManager();
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute(array(':tipo'=>$tipo));
       $redes = $smt->fetchAll();
       
        $phpExcelObject->setActiveSheetIndex(0)
           ->setCellValue('E5', $desde)
           ->setCellValue('I5', $hasta);
       
       $resultado = $this->get_tabla_semanal_enviar($redes, $inicio, $fin,$tipo);
       
       $phpExcelObject->getActiveSheet()->fromArray($resultado['primer'], NULL, 'A8');
       $phpExcelObject->getActiveSheet()->fromArray($resultado['celulas'], NULL, 'G8');
       $phpExcelObject->getActiveSheet()->fromArray($resultado['servicio'], NULL, 'H8');
       $phpExcelObject->getActiveSheet()->fromArray($resultado['nuevos'], NULL, 'I8');
       $phpExcelObject->getActiveSheet()->fromArray($resultado['ofrendas'], NULL, 'J8');

       
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=informe_semanal_celula.xlsx');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }


    public function informe_celulograma_viewAction()
    {
        return $this->render('AEEnviaBundle:Default:celulograma.html.twig');

    }
    
    public function informe_lideres_celula_viewAction()
    {
        return $this->render('AEEnviaBundle:Default:informe_lideres_celula.html.twig');
    }
    
    private function init_($n)
    {
        $result = array();
        for ($index = 0; $index < $n; $index++) {
            $result['id'.$index] = 0;
        }
        
        return $result;
    }
    
    private function get_tabla_lideres_celula_enviar($lideres, $red)
    {
        $em = $this->getDoctrine()->getManager();
        
        $resultado = array();
        $i = 0;
        $vacio = $this->init_(9);
        foreach ($lideres as $value) {
            
            $sql = "select * from get_celula_lider(:id,:red)";
            $smt = $em->getConnection()->prepare($sql);
            $smt->execute(array(':id'=>$value['id'],':red'=>$red));
            $celulas = $smt->fetchAll();
            if(count($celulas) >0)
            {
                
                foreach ($celulas as $v) {
                    $resultado[] = array_merge($value,  $v);
                    
                }
            }
            else
            {
               $resultado[] =  array_merge($value,  $vacio);
            }
            $i++;
        }
        
        return $resultado;
    }
    
    public function informe_lideres_celula_serviceAction()
    {
       $request = $this->get('request');
       $red =$request->request->get('red_lista');
       $nivel = $request->request->get('nivel');
                
        
       
       getcwd();
       chdir('report\enviar');
       $path = getcwd()."\informe_enviar.xls";
       
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($path);
       
       $tipo = 144;
       if($nivel == 'todo')
       {
           $padre = $request->request->get('lider_id');
           $tipo = 144;
       }
       elseif ($nivel == 'doce') {
       
           $padre = $request->request->get('doce_lista');
           $tipo = 1728;
        }
       else
       {
           $padre = $request->request->get('ciento_lista');
           $tipo = 20736;
       }
       
       //recuperamos lideres
       
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_padre_hijo_nivel(:padre,:tipo)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':padre'=>$padre, ':tipo'=>$tipo));
        $lideres = $smt->fetchAll();    
        
       
       $resultado = $this->get_tabla_lideres_celula_enviar($lideres, $red);
       
       //$phpExcelObject->getActiveSheet()->fromArray($lideres, NULL, 'A8');
           $phpExcelObject->getActiveSheet()->fromArray($resultado, NULL, 'A8');


       
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=informe_semanal_celula.xlsx');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }

    private function set_cabezera_celulograma(&$phpExcelObject, $informacion)
    {
        $phpExcelObject->setActiveSheetIndex(0)
           ->setCellValue('L5', $informacion['id'])
           ->setCellValue('B15', $informacion['apertura'])
           ->setCellValue('C11', $informacion['tipo'])
            ->setCellValue('H13', $informacion['familia'])
            ->setCellValue('B15', $informacion['apertura'])
             ->setCellValue('B13', $informacion['direccion'])
           ->setCellValue('E13', $informacion['tel_cell'])
           ->setCellValue('H15', $informacion['hora'])
           ->setCellValue('B9', $informacion['nombres'])
           ->setCellValue('J9', $informacion['edad'])
            ->setCellValue('H9', $informacion['dni'])
            ->setCellValue('E9', $informacion['tel_lider'])
           ->setCellValue('E15', $informacion['dia'])
           ;
        
         $tipo = 0;
         if($informacion['lider_12']==1)
         {
             $tipo= 12;
         }
         elseif ($informacion['lider_144']==1) {
             $tipo = 144;
        }
         elseif ($informacion['lider_1728']==1) {
             $tipo = 1728;
        }
         elseif ($informacion['lider_20736']==1) {
             $tipo = 20736;
        }
        
        $phpExcelObject->setActiveSheetIndex(0)
           ->setCellValue('E7', $tipo);
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
    
    private function rows_to_column($asistencias,  $n)
    {
        $semanas = $this->init_fila($n);
        
        foreach ($asistencias as $i) {
            $semanas[$i['semana']-1] = $i['tick'];
        }
        
        return $semanas;
        
    }

    private function get_columnas($miembros, $inicio, $fin)
    {
        $crecimiento = array();
        $asis_tabla = array();
        
        $em = $this->getDoctrine()->getManager();        
        $serie = $this->serie_semana($inicio, $fin);        
        $n = count($serie);
        
        foreach ($miembros as $i) {
            
            $fila = array();
            $id = $i['id'];
            
            $sql = "select * from check_consolidado(:id)";
            $smt = $em->getConnection()->prepare($sql);
            $smt->execute(array(':id'=>$id));
            
            $fila['le'] = $smt->fetch();
            
            //check cursos
            $sql = "select * from get_check_cursos_persona(:id)";
            $smt1 = $em->getConnection()->prepare($sql);
            $smt1->execute(array(':id'=>$id));
            $cursos_tick = $smt1->fetchAll();
            
            foreach ($cursos_tick as $c) {
                $fila['id'.$c['id']] = $c['tick'];
            }

            $crecimiento[] = $fila;
            
            //asistencia celulas
            $sql2 = "select * from get_asistencia_celula_persona(:per,:ini,:fin)";
            $smt2 = $em->getConnection()->prepare($sql2);
            $smt2->execute(array( ':per'=> $id, ':ini'=>$inicio, ':fin'=>$fin));
            $asistencias = $smt2->fetchAll();
            
            $asit_col = $this->rows_to_column($asistencias,  $n);
            $asis_tabla[] = $asit_col;
            
        }
        
        return array('crecimiento'=>$crecimiento, 'asiste'=>$asis_tabla);
    }
    public function informe_celulograma_serviceAction($cell, $year)
    {
        /*
        $request = $this->get('request');
       $red =$request->request->get('red_lista');
       $nivel = $request->request->get('nivel');
                
        */
        
        $inicio = $year.'-01-01';
        $fin = $year.'-12-30';
       
       getcwd();
       chdir('report\enviar');
       $path = getcwd()."\informe_celulograma.xls";
       
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($path);

       $em = $this->getDoctrine()->getManager();
       
       //get informacion celula
       $sql = "select * from get_info_celula(:cell)";
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute(array(':cell'=>$cell));
       
       $informacion = $smt->fetch();
       
       $this->set_cabezera_celulograma($phpExcelObject, $informacion);
       
       //get informacion miembros célula
       
       $sql = "select * from get_miembros_cell(:cell)";
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute(array(':cell'=>$cell));
       $miembros = $smt->fetchAll();
       
       //get otras columnas
       
       $resultado = $this->get_columnas($miembros, $inicio, $fin);
       
      // $phpExcelObject->getActiveSheet()->fromArray($informacion, NULL, 'B6');
       $phpExcelObject->getActiveSheet()->fromArray($miembros, NULL, 'A20');
       
       $phpExcelObject->getActiveSheet()->fromArray($resultado['crecimiento'], NULL, 'F20');
       
       $primero = $resultado['crecimiento'][0];
       $n = count($primero);
       
       //set serie semana
       $semanas = $this->serie_semana($inicio, $fin);
       $week = array();
       foreach ($semanas as $w) {
           $week[$w['semana']] =$w['fecha'];
       }
       
       $phpExcelObject->getActiveSheet()->fromArray($resultado['asiste'], NULL, chr(70+$n).'20');
       $phpExcelObject->getActiveSheet()->fromArray($week, NULL, chr(70+$n).'19');

       
       //set cursos
       
       $sql = "select * from view_get_cursos_all_activos";
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute();
       $cursos = $smt->fetchAll();
       
       $cur = array();
       foreach ($cursos as $c) {
           $cur[$c['id']] = $c['titulo'];
       }
       
       $phpExcelObject->getActiveSheet()->fromArray($cur, NULL, 'G19');

       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=informe_celulograma.xlsx');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }

    
    }

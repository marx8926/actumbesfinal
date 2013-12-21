<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\GanaBundle\Controller;

/**
 * Description of InformeController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class InformeController extends Controller {
    //put your code here
    
    public function semanalAction()
    {
    
          // ask the service for a Excel5
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

       $phpExcelObject->getProperties()->setCreator("liuggio")
           ->setLastModifiedBy("Giulio De Donato")
           ->setTitle("Office 2005 XLSX Test Document")
           ->setSubject("Office 2005 XLSX Test Document")
           ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
           ->setKeywords("office 2005 openxml php")
           ->setCategory("Test result file");
       
       
       $phpExcelObject->setActiveSheetIndex(0)
           ->setCellValue('A1', 'Hello')
           ->setCellValue('B2', 'world!');
       
       //$phpExcelObject->getActiveSheet()->setTitle('Simple');
       //
       $sql = "select * from persona";
       $em = $this->getDoctrine()->getManager();
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute();
       $todos = $smt->fetchAll();
       
       $phpExcelObject->getActiveSheet()->fromArray($todos, NULL, 'A1');
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=stream-file.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }
    
    public function detallado_viewAction()
    {
        return $this->render('AEGanaBundle:Default:informedetallado.html.twig');
    }
    
    public function detallado_serviceAction()
    {
            // ask the service for a Excel5
        
        $request = $this->get('request');
        $red =$request->request->get('red_lista');
        $desde = $request->request->get('desde');
        $hasta = $request->request->get('hasta');
        $em = $this->getDoctrine()->getManager();
        
        
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

       $phpExcelObject->getProperties()->setCreator("AdminChurch.com")
           ->setLastModifiedBy("AdminChurch.com")
           ->setTitle("AdminChurch.com 2005 XLSX Document")
           ->setSubject("AdminChurch.com 2005 XLSX  Document")
           ->setCategory("AdminChurch.com report");
       
       $todos = array();
       
       $fech_b = $desde;
       $fech_a =explode('/', $fech_b,3);
       $inicio = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0];  
       
       $fech_b = $hasta;
       $fech_a =explode('/', $fech_b,3);
       $fin = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0]; 
       
       if($red != -1)
       {
           if($red == 0)
           {
               $sql = "select * from get_informe_todos_rango(:ini,:fin)";
               $smt = $em->getConnection()->prepare($sql);
               $smt->execute(array(':ini'=>$inicio, ':fin'=>$fin));
               $todos = $smt->fetchAll();
               
           }
           else
           {
                $sql = "select * from get_informe_todos_rango_red(:ini,:fin,:red)";
                $smt = $em->getConnection()->prepare($sql);
                $smt->execute(array(':ini'=>$inicio, ':fin'=>$fin, ':red'=>$red));
                $todos = $smt->fetchAll();
           }
       }
       
       $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A1', 'Semana del '.$inicio.' al '.$fin)
           ->setCellValue('A2', 'RED')
               ->setCellValue('B2', 'DOCE DEL PASTOR')
               ->setCellValue('C2','NOMBRES Y APELLIDOS DEL NUEVO')
               ->setCellValue('D2','CONVERSION')
               ->setCellValue('E2','LIDER GANADRO DE ALMAS')
               ->setCellValue('F2','¿DONDE LO GANÓ?');
       
       $phpExcelObject->getActiveSheet()->setTitle('Ganados');
       
       
       $phpExcelObject->getActiveSheet()->fromArray($todos, NULL, 'A3');
      
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=reporte-'.$inicio.'_'.$fin.'.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }

    
    public function semanal_viewAction()
    {
        return $this->render('AEGanaBundle:Default:informesemanal.html.twig');
    }
    
    public function semanal_serviceAction()
    {
          // ask the service for a Excel5
        
        $request = $this->get('request');
        $tipo =$request->request->get('tipo_red');
        $desde = $request->request->get('desde');
        $hasta = $request->request->get('hasta');
        $em = $this->getDoctrine()->getManager();
        
        
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

       $phpExcelObject->getProperties()->setCreator("AdminChurch.com")
           ->setLastModifiedBy("AdminChurch.com")
           ->setTitle("AdminChurch.com 2005 XLSX Document")
           ->setSubject("AdminChurch.com 2005 XLSX  Document")
           ->setCategory("AdminChurch.com report");
       
       $todos = array();
       
       $fech_b = $desde;
       $fech_a =explode('/', $fech_b,3);
       $inicio = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0];  
       
       $fech_b = $hasta;
       $fech_a =explode('/', $fech_b,3);
       $fin = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0]; 
       
       //recuperar x redes
       $sql = "SELECT * from get_informe_ganar_todos_semanal_tipo(:ini,:fin,:tipo)";
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute(array(':ini'=>$inicio, ':fin'=>$fin,':tipo'=>$tipo));
       $todos = $smt->fetchAll();
       
       
       $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A1', 'Semana del '.$inicio.' al '.$fin)
           ->setCellValue('A2', 'RED')
               ->setCellValue('B2', 'LIDERES DE RED')
               ->setCellValue('C2','META POR RED')
               ->setCellValue('D2','GANADOS')
               ->setCellValue('E2','DESCARTADOS')
               ->setCellValue('F2','LUGAR DONDE SE GANARON LAS ALMAS');
       
       $phpExcelObject->getActiveSheet()->setTitle('Ganados');
       
       
       $phpExcelObject->getActiveSheet()->fromArray($todos, NULL, 'A3');
       
       
       //recuperar cantidad x lugares
       $sql1 = "select * from get_informe_ganar_todos_semanal_por_lugar(:ini,:fin)";
       $smt1 = $em->getConnection()->prepare($sql1);
       $smt1->execute(array(':ini'=>$inicio, ':fin'=>$fin));
       $lugares = $smt1->fetchAll();
       
       $phpExcelObject->getActiveSheet()->fromArray($lugares, NULL, 'F3');

       
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=reporte-'.$inicio.'_'.$fin.'.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
        
    }
    
    public function informe_tri_anual_viewAction()
    {
        return $this->render('AEGanaBundle:Default:informetri_anual.html.twig');
    }
    
    private function init_fila($n)
    {
        $row = array();
        
        for ($i = 0; $i < $n; $i++) {
            $row[] = '0';
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
    public function informe_tri_anual_serviceAction()
    {
            // ask the service for a Excel5
        
        $request = $this->get('request');
        $tipo =$request->request->get('tipo');
        $red = $request->request->get('red_lista');
        $desde = $request->request->get('desde');
        $year = $request->request->get('year');
        
        $em = $this->getDoctrine()->getManager();
        
        $meses_lista = array('ENE','FEB','MAR','ABR','MAY', 'JUN', 'JUL', 'AGO','SET', 'OCT','NOV','DIC','TOTAL');
        
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

       $phpExcelObject->getProperties()->setCreator("AdminChurch.com")
           ->setLastModifiedBy("AdminChurch.com")
           ->setTitle("AdminChurch.com 2005 XLSX Document")
           ->setSubject("AdminChurch.com 2005 XLSX  Document")
           ->setCategory("AdminChurch.com report");
       
       $todos = array();
       
       
       if($desde == '1')
       {
           $inicio = $year.'-01-01';
           $fin = $year.'-03-31';
       }
       elseif ($desde == '2') {
           $inicio = $year.'-04-01';
           $fin = $year.'-06-30';
       }
       elseif ($desde=='3') {
           $inicio = $year.'-07-01';
           $fin = $year.'-09-30';
       }
       else{
           $inicio = $year.'-10-01';
           $fin = $year.'-12-31';
       }
      
      $semana_serie = $this->serie_semana($inicio, $fin);
       
      if($red != -1 && strlen($tipo)>0) 
      {    
        //recuperamos a los lideres 
        $sql = "select * from get_informe_ganar_lideres(:red)";       
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $todos = $smt->fetchAll();
        $matriz = array();
        foreach ($todos as $item) {
            
            if($tipo == 'anual')
            {
                
                $ini = $year.'-01-01';
                $fin = $year.'-12-31';
                
                $meses = $this->init_fila(13);
                
                $sql = "select * from get_informe_ganados_por_mes(:ini, :fin,:id)";       
                $smt = $em->getConnection()->prepare($sql);
                $smt->execute(array(':ini'=>$ini,':fin'=>$fin, ':id'=>$item['id']));
                $resultado = $smt->fetchAll();
                if(count($resultado)> 0){
                    foreach ($resultado as $i)
                    {
                        $meses[$i['mes']-1] = $i['ganados'];
                        
                        
                    }
                }
                $meses[12] = array_sum($meses);
                if($meses[12]==0)
                    $meses[12]='0';
                
                $fila = $item;
                foreach ($meses as $m) {
                    $fila[] = $m;
                }
                $matriz[] = $fila;
            }
            if($tipo=='tri')
            {
                $n = count($semana_serie);
                
                $semanas = $this->init_fila($n);
                
                $sql = "select * from get_informe_ganados_por_semana(:ini, :fin,:id)";       
                $smt1 = $em->getConnection()->prepare($sql);
                $smt1->execute(array(':ini'=>$inicio,':fin'=>$fin, ':id'=>$item['id']));
                $resultado = $smt1->fetchAll();
                if(count($resultado)> 0){
                    foreach ($resultado as $i)
                    {
                        $semanas[$i['semana']-$semana_serie[0]['semana']] = $i['ganados'];
                    }
                }
                
                $semanas[$n] = array_sum($semanas);
                
                if($semanas[$n]==0)
                    $semanas[$n]='0';
                
                $fila = $item;
                foreach ($semanas as $s) {
                    $fila[] = $s;
                }
                $matriz[] = $fila;
            }
        }
       
       
        $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A1', 'Semana del '.$inicio.' al '.$fin)
               ->setCellValue('C1','Red: '.$red)
           ->setCellValue('A2', 'N°')
               ->setCellValue('B2', 'NOMBRE DEL LIDER')
               ->setCellValue('C2','TELEFONO')
              ;
       
       $phpExcelObject->getActiveSheet()->setTitle('INFORME');
       
       if($tipo == 'anual')
       {
           $phpExcelObject->getActiveSheet()->fromArray($meses_lista, NULL, 'D2');
       }
       else {
           $semanas_lista = array();
           
           foreach ($semana_serie as $s) {
               $semanas_lista[]=$s['fecha'];
           }
           $semanas_lista[] = 'Total';
           $phpExcelObject->getActiveSheet()->fromArray($semanas_lista, NULL, 'D2');

       }
       
       $phpExcelObject->getActiveSheet()->fromArray($matriz, NULL, 'A3');
       
      
      }
       
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=reporte-'.$inicio.'_'.$fin.'.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }
}

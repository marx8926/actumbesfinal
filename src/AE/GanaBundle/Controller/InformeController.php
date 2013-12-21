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
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ConsolidaBundle\Controller;

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
    
    public function resumido_viewAction()
    {
        return $this->render('AEConsolidaBundle:Default:informeresumido.html.twig');
    }
    
    private function no_consolidados($ini, $fin, $tipo)
    {
        $em = $this->getDoctrine()->getManager();
        
        //recuperamos la red
        
        $sql_r = "select int_red_id, id from red where tipo=:tip order by id";
        $smt_r = $em->getConnection()->prepare($sql_r);
        $smt_r->execute(array(':tip'=>$tipo));
        $redes = $smt_r->fetchAll();
        
        $fila = array();
       
        $em->clear();
        $em->flush();
        
        $tabla = array();
        
        foreach ($redes as $r) {
            
            $fila = [];
            $sql_r = "select  ca.consolidar_id  from consolidado_asistencia ca inner join consolidar c on c.int_consolidar_id=ca.consolidar_id 
                and ca.fin is null and ca.inicio between :ini and :fin
                inner join detalle_miembro d on d.red_id=:red and d.persona_id=c.consolidado_id 
                group by ca.consolidar_id";
            $smt = $em->getConnection()->prepare($sql_r);
            $smt->execute(array(':ini'=>$ini,':fin'=>$fin,':red'=>$r['int_red_id']));
            $row = $smt->fetchAll();
            
            $n = count($row);
            if($n == 0)
                $fila[] =  '0';
            else
                $fila[] = $n;
            
            $tabla[] = $fila;
            
            //$fila[] = $r['int_red_id'];
        }
     
        return $tabla;
    }
    
    public function resumido_serviceAction()
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
           ->setTitle("AdminChurch.com  XLSX Document")
           ->setSubject("AdminChurch.com  XLSX  Document")
           ->setCategory("AdminChurch.com report");
       
       $todos = array();
       
       $fech_b = $desde;
       $fech_a =explode('/', $fech_b,3);
       $inicio = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0];  
       
       $fech_b = $hasta;
       $fech_a =explode('/', $fech_b,3);
       $fin = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0]; 
       
       //recuperar x redes
       $sql = "SELECT * from get_informe_consolidar_por_semana(:ini,:fini,:tipo,:byear)";
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute(array(':ini'=>$inicio, ':fini'=>$fin,':tipo'=>$tipo,':byear'=> ($fech_a[2].'-01-01')));
       $todos = $smt->fetchAll();
       
       
       $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A1', 'Semana del '.$inicio.' al '.$fin)
           ->setCellValue('A2', 'RED')
               ->setCellValue('B2', 'LIDER DE 12')
               ->setCellValue('C2','PERSONAS POR CONSOLIDAR')
               ->setCellValue('D2','PERSONAS CONSOLIDADOS')
               ->setCellValue('E2','DESCARTADOS')
               ->setCellValue('F2','NO CONSOLIDADOS')
               ->setCellValue('G2','PREPARDO PARA EL ENCUENTRO');
       
       $phpExcelObject->getActiveSheet()->setTitle('CONSOLIDACION');
       
       
       $phpExcelObject->getActiveSheet()->fromArray($todos, NULL, 'A3');
       
       
       //no consolidados en el rango
       
       $no_con = $this->no_consolidados($inicio, $fin, $tipo);
       
        $phpExcelObject->getActiveSheet()->fromArray($no_con, NULL, 'F3');

       
       
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

        public function detallado_viewAction()
    {
        return $this->render('AEEnviaBundle:Default:informedetallado.html.twig');
    }
    
    public function anual_tri_viewAction()
    {
        return $this->render('AEConsolidaBundle:Default:informe_anual_tri.html.twig');
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
    
    public function anual_tri_serviceAction()
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
        //recuperamos a los consolidadores
          
        $sql = "select * from get_consolidador_red(:red)";       
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
                
                $sql = "select * from get_informe_consolidados_por_mes(:ini, :fin,:id)";       
                $smt = $em->getConnection()->prepare($sql);
                $smt->execute(array(':ini'=>$ini,':fin'=>$fin, ':id'=>$item['id']));
                $resultado = $smt->fetchAll();
                if(count($resultado)> 0){
                    foreach ($resultado as $i)
                    {
                        $meses[$i['mes']-1] = $i['consolidados'];                        
                        
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
                
                $sql = "select * from get_informe_consolidados_por_semana(:ini, :fin,:id)";       
                $smt1 = $em->getConnection()->prepare($sql);
                $smt1->execute(array(':ini'=>$inicio,':fin'=>$fin, ':id'=>$item['id']));
                $resultado = $smt1->fetchAll();
                if(count($resultado)> 0){
                    foreach ($resultado as $i)
                    {
                        $semanas[$i['semana']-$semana_serie[0]['semana']] = $i['consolidados'];
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
               ->setCellValue('B2', 'NOMBRE DEL CONSOLIDADOR')
              ;
       
       $phpExcelObject->getActiveSheet()->setTitle('INFORME');
       
       if($tipo == 'anual')
       {
           $phpExcelObject->getActiveSheet()->fromArray($meses_lista, NULL, 'C2');
       }
       else {
           $semanas_lista = array();
           
           foreach ($semana_serie as $s) {
               $semanas_lista[]=$s['fecha'];
           }
           $semanas_lista[] = 'Total';
           $phpExcelObject->getActiveSheet()->fromArray($semanas_lista, NULL, 'C2');

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

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\DiscipulaBundle\Controller;

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
    
    
       
    public function viewAction()
    {
       return $this->render('AEDiscipulaBundle:Default:estudiante.html.twig');
    }
    
    public function editAction()
    {
        
    }
    public function saveAction()
    {
        
    }
    
    public function deleteAction()
    {
        
    }
    
    public function informe_estudiantes_redAction()
    {

        $request = $this->get('request');
        $red =$request->request->get('net');
        
       getcwd();
       chdir('report\discipular');
       $path = getcwd()."\informe_estudiantes.xls";
       
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($path);

       $sql = "select * from get_niveles_all_tabla_red_exportar(:net,4,1)";
       $em = $this->getDoctrine()->getManager();
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute(array(':net'=>$red));
       $todos = $smt->fetchAll();
       
       $phpExcelObject->getActiveSheet()->fromArray($todos, NULL, 'A9');
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=estudiantes.xlsx');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }

    
    public function informe_docentes_allAction()
    {        
       
       getcwd();
       chdir('report\discipular');
       $path = getcwd()."\informe_docentes.xls";
       
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($path);

       $sql = "SELECT  nombres, red, inicio, telefonos, estado FROM view_get_profesores_all";
       $em = $this->getDoctrine()->getManager();
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute();
       $todos = $smt->fetchAll();
       
       $phpExcelObject->getActiveSheet()->fromArray($todos, NULL, 'A9');
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=docentes.xlsx');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }

    
    public function informe_aula_allAction()
    {
       getcwd();
       chdir('report\discipular');
       $path = getcwd()."\informe_aulas.xls";
       
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($path);

       $sql = "SELECT  nombre, creado, capacidad, activo  FROM view_get_all_aulas";
       $em = $this->getDoctrine()->getManager();
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute();
       $todos = $smt->fetchAll();
       
       $phpExcelObject->getActiveSheet()->fromArray($todos, NULL, 'A9');
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=aulas.xlsx');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }
    
    private function asignacion_detalle_tabla($detalle, $num_lecciones)
    {
        //select * from get_asistencia_detalle(1);
        
        $em = $this->getDoctrine()->getManager(); 
        $sql = "select * from get_asistencia_detalle_discipular(:detalle)";
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':detalle'=>$detalle));
        $result = $smt->fetchAll();       
        
        $num_total = count($result);        
        $grupos = $num_total/$num_lecciones;        
        $resultado = array();
        
        //recuperar ofrendas asistencia
        $sql2 = "select * from get_ofrenda_aplicacion_detalle(:detalle)";
        $smt2 = $em->getConnection()->prepare($sql2);
        $smt2->execute(array(':detalle'=>$detalle));
        $asistencias = $smt2->fetchAll();
        
        $fechas = array();
        $ofrendas = array();
        
        $fechas['nro'] = ''; $ofrendas['nro'] = '';
        $ofrendas['nro'] = '';
        $fechas['nombres'] = 'Aplicado'; $ofrendas['nombres'] = 'Ofrendas';
        $fechas[] = ''; $ofrendas[] = '';
        $fechas[] = ''; $ofrendas[] = '';
        $fechas[] = ''; $ofrendas[] = '';
        $fechas[] = ''; $ofrendas[] = '';
        $y = 1;
        foreach ($asistencias as $value) {
            
            $patron = "L".strval($y); 
            
            if(strlen($value['aplicacion']) > 0)
                $fechas[$patron] = $value['aplicacion'];
            else
                $fechas[$patron] = "";
            
            $ofrendas[$patron] = $value['ofrenda'] ;
            
            $y++;
        }
        $resultado[] = $fechas;
        $resultado[] = $ofrendas;
        
        for ($i = 0; $i< $grupos; $i++) {
            
            $item = array();
            $item['nro'] = strval($i+1);
            $item['nombres'] = $result[$i*$num_lecciones]['nombres'];            
            $item['tel1'] = $result[$i*$num_lecciones]['tel1'];
            $item['lider'] = $result[$i*$num_lecciones]['lider'];
            $item['tel2'] = $result[$i*$num_lecciones]['tel2'];
            $item['net'] = $result[$i*$num_lecciones]['net'];

            
            for($j = 0; $j<$num_lecciones; $j++)
            {
                $patron = "L".strval($j+1);                
                $p = "";
                //asistencia
                if($result[$j+$i*$num_lecciones]['asistencia'])
                    $p = "✓";
               else if($result[$j+$i*$num_lecciones]['aplicacion']!= NULL)
                   $p = "x ";
               else $p = " ";
                //nota                   
                $p = $p.$result[$j+$i*$num_lecciones]['nota'];                
                $item[$patron] = $p;                
            }
            $resultado[] = $item;
        }
        
        return  $resultado; 
    }
    
    public function informe_asignacion_detalleAction()
    {
       getcwd();
       chdir('report\discipular');
       $path = getcwd()."\informe_asignacion.xls";
       
       $request = $this->get('request');
       $curso =$request->request->get('nombre');
       $dia = $request->request->get('dia');
       $inicio =$request->request->get('inicio');
       $fin =$request->request->get('fin');
       $hinicio =$request->request->get('hinicio');
       $hfin =$request->request->get('hfin');
       $estado =$request->request->get('estado');
       $clases =$request->request->get('clases');
       $requisito =$request->request->get('requisito');
       $detalle =$request->request->get('id_detalle');
       $docente =$request->request->get('docente');                
       
       
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($path);

       
       $todos = $this->asignacion_detalle_tabla($detalle, $clases);
       
       $phpExcelObject->getActiveSheet()->fromArray($todos, NULL, 'A12');
       
       //creamos los patrones 
       $y = 1;
       $fila = array();
       for ($y = 1; $y <= $clases; $y++) {
      
            $patron = "L".strval($y);             
            $fila[] = $patron;
        }
        $phpExcelObject->getActiveSheet()->fromArray(array($fila), NULL, 'G11');

        
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);
       
       //agregamos otros datos a la tabla
       
       $phpExcelObject->setActiveSheetIndex(0)
           ->setCellValue('D5', $curso)
           ->setCellValue('H5', $requisito)
           ->setCellValue('L5', $docente)
           ->setCellValue('D7', $dia)
           ->setCellValue('H7', $hinicio)
           ->setCellValue('L7', $hfin)
           ->setCellValue('D9', $estado)
           ->setCellValue('H9', $inicio)
           ->setCellValue('L9', $fin);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=reporte_asignacion.xlsx');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response; 
    }
    
    public function informe_semanal_indeli_viewAction()
    {
        return $this->render('AEDiscipulaBundle:Default:informe_semanal_indeli.html.twig');
    }
    
     
    public function informe_semanal_indeli_serviceAction()
    {
        
    }
    
    
    
    public function informe_alumnos_indeli_viewAction()
    {
        return $this->render('AEDiscipulaBundle:Default:informe_alumnos_red_indeli.html.twig');
    }
    
     
    public function informe_alumnos_indeli_serviceAction()
    {
        
    }
    
}

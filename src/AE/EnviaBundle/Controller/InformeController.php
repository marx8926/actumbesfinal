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
            
            $sql = "SELECT * from get_informe_ganar_resumen_por_rango_lider_celula(:net)";
            $smt = $em->getConnection()->prepare($sql);
            $smt->execute(array(':net'=>$value['int_red_id']));
            
        }
        
        return $resultado;
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

       $sql = "select * from get_redes_activas_tipo(:tipo)";
       $em = $this->getDoctrine()->getManager();
       $smt = $em->getConnection()->prepare($sql);
       $smt->execute(array(':tipo'=>$tipo));
       $redes = $smt->fetchAll();
       
       $resultado = $this->get_tabla_semanal_enviar($redes, $inicio, $fin,$tipo);
       
       $phpExcelObject->getActiveSheet()->fromArray($resultado, NULL, 'A9');
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


    public function informe_celulograma_viewAction()
    {
        return $this->render('AEEnviaBundle:Default:celulograma.html.twig');

    }
    
    public function informe_lideres_celula_viewAction()
    {
        return $this->render('AEEnviaBundle:Default:informe_lideres_celula.html.twig');
    }
}

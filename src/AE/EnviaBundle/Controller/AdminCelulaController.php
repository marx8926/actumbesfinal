<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\EnviaBundle\Controller;

/**
 * Description of AdminCelulaController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;

class AdminCelulaController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEEnviaBundle:Default:admincelula.html.twig',array('red'=> NULL));

    }
    
    public function enrolarAction()
     {
        $request = $this->get('request');
        $datos =$request->request->get('formulario'); 
        $enrolados = $request->request->get('en');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            $en_rolado = $datos['en_celula'];
            
            
            $total = $en_rolado;
            $enr = array();
            
            if(count($enrolados)> 0)
            {
               
                if(count($enrolados) == 1)
                    $enr[] = $enrolados;
                else
                {
                    foreach ($enrolados as $value) {
                        $enr[] = $value['id'];
                    }
                }
            }
            
            //por eliminar
           // $eliminar = array_diff($enr, $en_rolado);
            $eliminar = [];
            if(count($eliminar)>0)
            {
                //procedimiento para eliminar
                $el = array();
                if(count($eliminar)==1)
                    $el[]=$eliminar;
                else $el = $eliminar;
                
                 foreach ($el as $e) {
                    
                    //actualizamos cada uno
                    $sql = "select  update_miembro_celula_null(:id)";
                    $smt = $em->getConnection()->prepare($sql);
                    $smt->execute(array(':id'=>$e));
                }
            }
            
            //por añadir
            $add = $en_rolado;
            
            $celula = $datos['matricular_id'];
            
            //por añadir
            if(count($add)>0)
            {
                $rows = array();
                if(count($add)==1)
                    $rows[]= $add;
                else 
                    $rows = $add;
                
                foreach ($rows as $r) {
                    
                    //actualizamos cada uno
                    $sql = "select  update_miembro_celula(:id,:cell)";
                    $smt = $em->getConnection()->prepare($sql);
                    $smt->execute(array(':id'=>$r,':cell'=>$celula));
                }
            }
           
            $em->commit();
            
            $return=array("responseCode"=>200, "greeting"=>"Ok");
        } catch (Exception $ex) {
            $em->rollback();
            $em->close();
            $em->clear();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        
        return new JsonResponse($return);
        
    }
    
    public function desactivarAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario'); 
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            $celula_old = $datos['celula_id'];
            $tipo = $datos['tipo_celula'];
            $cell = $datos['cambio_celula'];            
            
            $repo_cell = $em->getRepository('AEDataBundle:Celula');
            $celula = $repo_cell->find($cell);
            $old = $repo_cell->find($celula_old);
            
            $old->setActivo(FALSE);
            $em->persist($old);
            $em->flush();
            
            $detalles = $em->getRepository('AEDataBundle:DetalleMiembro')->findBy(array('celula' => $celula_old));
            $n = count($detalles);
            
            
            foreach ($detalles as $item) {                
                $item->setCelula($celula);               
                $em->persist($item);   
                $em->flush();
            }
            $em->commit();
            
            $return=array("responseCode"=>200, "greeting"=>$n);
        } catch (Exception $ex) {
            $em->rollback();
            $em->close();
            $em->clear();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        
        return new JsonResponse($return);
        
    }
}

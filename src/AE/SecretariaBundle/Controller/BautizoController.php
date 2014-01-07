<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\SecretariaBundle\Controller;

/**
 * Description of BautizoController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Bautizo;

class BautizoController extends Controller {
    //put your code here
    
    public function viewAction()
    {
       return $this->render('AESecretariaBundle:Default:bautizo.html.twig');
    }
    
    public function saveAction()
    {
         $request = $this->get('request');
        $datos =$request->request->get('formulario');
        $tabla = $request->request->get('tabla');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            
            $fechaConv_b = $datos['f_inicio'];            
            $fechaConv_a = explode('/', $fechaConv_b, 3);            
            $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0]; 
            
            $hora = $datos['h_inicio'];
            $lugar = $datos['lugar'];
            $pastor = $datos['pastor'];
           
            $bautizo = new Bautizo();
            $bautizo->setFecha(new \DateTime($fecha));
            $bautizo->setHora($hora);
            $bautizo->setLugar($lugar);
            $bautizo->setPastor($pastor);

            $em->persist($bautizo);
            $em->flush();
  
            $sql = "select update_bautizo_miembro(:id,:bau)";
        
            foreach ($tabla as $value) {                
                $smt = $em->getConnection()->prepare($sql);
                $smt->execute(array(':id'=> $value['id'],':bau'=>$bautizo->getId()));                
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
}

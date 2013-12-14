<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EliminarController
 *
 * @author Marks-Calderon
 */

namespace AE\GanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class EliminarController extends Controller {
    //put your code here
    
    public function elimina_personaAction()
    {
        $request = $this->get('request');
        $id =$request->request->get('formulario');
        
        $return = array();
        
        if($id != NULL)
        {
            $em = $this->getDoctrine()->getManager();            
            
            
            $em->beginTransaction();            
            try{             
                
                $prev_div = $em->getRepository('AEDataBundle:Persona');
                $persona = $prev_div->findOneBy(array('id'=>$id));                
                $ubicacion = $persona->getIdUbicacion();        
                
                $prev_nivel = $em->getRepository('AEDataBundle:NivelCrecimiento');
                $nivel = $prev_nivel->findBy(array('persona' => $id));
                
                foreach ($nivel as $value) {
                    $em->remove($value);
                    $em->flush();
                }
                
                $em->remove($ubicacion);
                $em->remove($persona);
                
                $det = $em->getRepository('AEDataBundle:DetalleMiembro')->findOneBy(array('personaId'=>$id));

                $em->remove($det);
                
                $em->flush();
                
                $em->commit();
                
                 $return=array("responseCode"=>200, "greeting"=>"OK");
                
            } catch (Exception $ex) {
                
                $em->rollback();
                $em->clear();
                $em->close();
                $return=array("responseCode"=>400, "greeting"=>"Bad");
            }
            
           
        }
        else
        {
            $return=array("responseCode"=>400, "greeting"=>"Bad");
        }
        
        return new JsonResponse($return);
    }
}

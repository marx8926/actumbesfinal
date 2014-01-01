<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\EnviaBundle\Controller;

/**
 * Description of LiderazgoController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Lider;

class LiderazgoController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEEnviaBundle:Default:liderazgo.html.twig');
    }
    
    public function agregar_lider_saveAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');
        $padre = $datos['agregar_id'];
        $hijo = $datos['lideres_sin'];
        
        $em = $this->getDoctrine()->getManager();
        
        $repo_lider = $em->getRepository('AEDataBundle:Lider');
        
        $l_padre = $repo_lider->find($padre);
        
        $l_hijo = $repo_lider->findBy(array('persona'=>$hijo));
        $flag = TRUE;
        
        $tipo = 12;
        
        $em->beginTransaction();
        try {
            
       

        if($l_hijo == null)
        {
            $l_hijo = new Lider();
            $l_hijo->setActivo(TRUE);
            $l_hijo->setDependencia($l_padre->getIntLiderId());
            $persona = $em->getRepository('AEDataBundle:Persona')->find($hijo);
            $l_hijo->setRed($persona->getRed());
            $l_hijo->setPersona($persona);
            $l_hijo->setFecha(new \DateTime());
            
            if($l_padre->getIntLider12()==1 )
            {
                $l_hijo->setIntLider144(1);
                $tipo = 144;
            }
            elseif ($l_padre->getIntLider144()==1 ) {
                $l_hijo->setIntLider1728(1);
                $tipo = 1728;
            }
            elseif ($l_padre->getIntLider1728()==1 ) {
                $l_hijo->setIntLider20736(1);
                $tipo = 20736;
            }
            elseif ($l_padre->getIntLider20736()==1 ) {
                $flag = FALSE;
            }
        

        }
        else
        {
            $l_hijo->setActivo(TRUE);
            $l_hijo->setDependencia($l_padre->getIntLiderId());
            $l_hijo->setRed($persona->getRed());
            $l_hijo->setFecha(new \DateTime());
            $l_hijo->setIntLider12(0);
            $l_hijo->setIntLider144(0);
            $l_hijo->setIntLider1728(0);
            $l_hijo->setIntLider20736(0);
            
            if($l_padre->getIntLider12()==1 )
            {
                $l_hijo->setIntLider144(1);
                $tipo = 144;
            }
            elseif ($l_padre->getIntLider144()==1 ) {
                $l_hijo->setIntLider1728(1);
                $tipo = 1728;
            }
            elseif ($l_padre->getIntLider1728()==1 ) {
                $l_hijo->setIntLider20736(1);
                $tipo = 20736;
            }
            elseif ($l_padre->getIntLider20736()==1 ) {
                $flag = FALSE;
            }
        }
    
        if($flag)
        {
            $em->persist($l_hijo);
            $em->flush();
            $item = array();
            $item['id'] = $l_hijo->getIntLiderId();
            $item['parent'] = $l_padre->getIntLiderId();
            $item['title'] = $l_hijo->getPersona()->getNombre()." ".$l_hijo->getPersona()->getApellidos();
            $item['description'] = "Lider ".strval($tipo)." de la red ".$l_hijo->getPersona()->getRed()->getId();
            $item['image'] = $l_hijo->getPersona()->getFoto()->getDireccion();

            $return=array("responseCode"=>200, "item"=>$item);
        }
        else
        {
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        $em->commit();
        
         } catch (Exception $exc) {
             $em->rollback();
            echo $exc->getTraceAsString();
        }
        
        return new JsonResponse($return);
    }
}

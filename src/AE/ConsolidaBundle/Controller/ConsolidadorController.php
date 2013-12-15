<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ConsolidaBundle\Controller;

/**
 * Description of ConsolidadorController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\NivelCrecimiento;


class ConsolidadorController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEConsolidaBundle:Default:consolidador.html.twig');
    }
    
    public function saveAction()
    {
         $request = $this->get('request');
        $id =$request->request->get('formulario');
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
       
            //$niv = $em->getRepository('AEDataBundle:NivelCrecimiento')->findOneBy(array('persona'=>$id,'intNivelcrecimientoEscala' => 4 ));
            
            $niv = NULL;
            
            if($niv == NULL)
            {
                $persona = $em->getRepository('AEDataBundle:Persona')->find($id);
                
                $nivel = new NivelCrecimiento();
                $nivel->setRed($persona->getRed());
                $nivel->setPersona($persona);
                $nivel->setCreacion(new \DateTime());
                $nivel->setIntNivelcrecimientoEscala(3);
                $nivel->setIntNivelcrecimientoEstadoactual(1);
                
                $em->persist($nivel);
                $em->flush();
                
            }
            else {
                $niv->setIntNivelcrecimientoEstadoactual(1);
                $em->persist($niv);
                $em->flush();
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
    
    public function editAction()
    {
        
    }
    
    public function deleteAction()
    {
        
    }
}

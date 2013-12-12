<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LiderController
 *
 * @author Marks-Calderon
 */
namespace AE\ConfigurarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Lider;
use AE\DataBundle\Entity\NivelCrecimiento;
use AE\DataBundle\Entity\Red;

class LiderController extends Controller {
    //put your code here
    public function viewAction()
    {
        return $this->render('AEConfigurarBundle:Default:lider.html.twig');
    }
    
    public function saveAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');        
        $em = $this->getDoctrine()->getManager();
        
        $fechaConv_b = $datos['creacion'];            
        $fechaConv_a = explode('/', $fechaConv_b, 3);            
        $fecha = $fechaConv_a[2].'-'.$fechaConv_a[1].'-'.$fechaConv_a[0];
        
        $em->beginTransaction();
        
        try{
            
            $nivel = $datos['nivel'];
            
            $doce = $datos['doce_lista'];
            $red = $datos['red_lista'];
                
            $net = $em->getRepository('AEDataBundle:Red')->find($red);
            $repo_persona = $em->getRepository('AEDataBundle:Persona');
            $repo_lider = $em->getRepository('AEDataBundle:Lider');
            
            
            
            if($nivel == 'doce')
            {
                $persona = $repo_persona->find($doce);
                
                if($net->getLider() != $persona) //cambiamos de lider de red
                {
                    //creando un nuevo lider
                    
                    //cambiado de red al lider
                    
                    //asignamos a la red
                        
                        $lid = $repo_lider->findOneBy(array('persona' => $doce));
                        
                        if($lid == NULL)
                        {
                            $lider_red = new Lider();
                            $lider_red->setIntLider12(1);
                            $lider_red->setIntLider144(0);
                            $lider_red->setIntLider1728(0);
                            $lider_red->setIntLider20736(0);
                            $lider_red->setFecha(new \DateTime($fecha));
                            $lider_red->setActivo(TRUE);
                            $lider_red->setPersona($persona);
                            $lider_red->setDependencia(0);
                            $lider_red->setRed($net);
                
                            $em->persist($lider_red);
                            $em->flush();
                        }
                        else
                        {
                           $lider_red = $lid;
                        }
                        
                        $net->setLider($persona);
                        $em->persist($net);
                        $em->flush();
                        
                         $return=array("responseCode"=>200, "greeting"=>"lider");
                }
                
            }
            elseif ($nivel == 'ciento') {
              $ciento = $datos['ciento_lista'];
              $persona = $repo_persona->find($ciento);
              
              $antecesor = $repo_lider->findOneBy(array('persona' => $doce, 'intLider12' => '1', 'red' => $red));
              
              if($antecesor != NULL)
              {
                  $he = $repo_lider->findOneBy(array('persona' => $ciento, 'intLider144' => '1', 'red' => $red));
                  
                  if($he ==NULL)
                  {
                      $lider = new Lider();
                      $lider->setIntLider12(0);
                      $lider->setIntLider144(1);
                      $lider->setIntLider1728(0);
                      $lider->setIntLider20736(0);
                      $lider->setFecha(new \DateTime($fecha));
                      $lider->setActivo(TRUE);
                      $lider->setPersona($persona);
                      $lider->setDependencia($antecesor->getIntLiderId());
                      $lider->setRed($net);
                
                      $em->persist($lider);
                      $em->flush();
                      
                      
                  }
                  else{
                      //ya se asigno
                      
                  }
              
              }
              else
              {
                  //errore en asignancion de datos
                  $return = array("responseCode"=>400, "greeting"=>"Ok");
              }
              
              //buscamos a su padre
              
              
            }
            elseif ( $nivel == 'mil')
            {
              $ciento = $datos['ciento_lista'];
              $mil = $datos['mil_lista'];
              $persona = $repo_persona->find($mil);
              
              $antecesor = $repo_lider->findOneBy(array('persona' => $ciento, 'intLider144' => '1', 'red' => $red));
              
              if($antecesor != NULL)
              {
                  $he = $repo_lider->findOneBy(array('persona' => $mil, 'intLider1728' => '1', 'red' => $red));
                  
                  if($he ==NULL)
                  {
                      $lider = new Lider();
                      $lider->setIntLider12(0);
                      $lider->setIntLider144(0);
                      $lider->setIntLider1728(1);
                      $lider->setIntLider20736(0);
                      $lider->setFecha(new \DateTime($fecha));
                      $lider->setActivo(TRUE);
                      $lider->setPersona($persona);
                      $lider->setDependencia($antecesor->getIntLiderId());
                      $lider->setRed($net);
                
                      $em->persist($lider);
                      $em->flush();
                      
                      
                  }
                  else{
                      //ya se asigno
                      
                  }
              
              }
              else
              {
                  //errore en asignancion de datos
                  $return = array("responseCode"=>400, "greeting"=>"Ok");
              }
              
              //buscamos a su padre
              
            }
            elseif( $nivel == 'veinte')
            {
                
            }
                
            
            $em->commit();
            $em->clear();
            
            $return=array("responseCode"=>200, "greeting"=>"ok");
            
        } catch (Exception $ex) {

            $em->rollback();
            $em->clear();
            $em->close();
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

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermisoController
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
use AE\DataBundle\Entity\NivelCrecimiento;
use AE\DataBundle\Entity\Persona;

class PermisoController extends Controller {
    //put your code here
    
    public function vistaAction()
    {
        
        return $this->render('AEConfigurarBundle:Default:permisos.html.twig');
        
    }
    
    public function guardarAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');
        
        $permisos = [];
        $permisos[] = 0;
        $form = ['miembro', 'lider', 'lider_red', 'consolidador', 'estudiante', 'docente',
            'ganar', 'consolidar', 'enviar', 'discipular', 'tesoreria', 'pastor', 'admin'];
        $roles = ['ROLE_USER', 'ROLE_LIDER', 'ROLE_LIDER_RED', 'ROLE_CONSOLIDADOR', 'ROLE_ESTUDIANTE',
            'ROLE_DOCENTE', 'ROLE_GANAR', 'ROLE_CONSOLIDAR', 'ROLE_ENVIAR', 'ROLE_DISCIPULAR', 
            'ROLE_TESORERIA', 'ROLE_ADMIN'];
        
        $cont = 1;
        
        $em = $this->getDoctrine()->getManager();
        
        $id = $datos['persona_id'];
        
        if($id == '-1')
        {
            $return=array("responseCode"=>400, "greeting"=>"Bad");            
            return new JsonResponse($return);           
        }
        
        $repo = $em->getRepository('AEDataBundle:Persona');
        $persona = $repo->find($id);
        
        
        
        $repo_nivel = $em->getRepository('AEDataBundle:NivelCrecimiento');
        
        $result = [];
        
        $userManager = $this->get('fos_user.user_manager');
        
        $user = $userManager->findUserBy(array('idPersona' => $id));
        
        
        
        
        $em->beginTransaction();
        try{
            //for ($index = 0; $index < 1; $index++) {
            foreach ($form as $value) {
            //    $value = $form[$index];
                
                
                if(array_key_exists($value, $datos))
                {                  
                    $niv = $repo_nivel->findOneBy(array('persona' => $id, 'intNivelcrecimientoEscala' => $cont));                    
                    
                    //return new JsonResponse($niv == NULL);
                    if($niv == NULL)
                    {
                        
                        $n = new NivelCrecimiento();
                        //$persona = new Persona();
                        $n->setRed($persona->getRed());
                        $n->setCreacion(new \DateTime());                      

                        $n->setPersona($persona);                        
                        $n->setIntNivelcrecimientoEscala($cont);
                        $n->setIntNivelcrecimientoEstadoactual(1);
                        
                        $em->persist($n);
                        $em->flush();
                        
                    }
                    else {
                        $niv->setIntNivelcrecimientoEstadoactual(1);
                        $em->persist($niv);
                        $em->flush();
                    }
                    //añadimos roles
                    if($user != NULL)
                    {
                                   
                      $user->addRole($roles[$cont-1]);
                      $userManager->updateUser($user);
                    }
                }
                else
                {
                    
                    $niv = $repo_nivel->findOneBy(array('persona' => $id, 'intNivelcrecimientoEscala' => $cont));
                    
                    if($niv != NULL)
                    {
                        $niv->setIntNivelcrecimientoEstadoactual(0);
                        $em->persist($niv);
                        $em->flush();
                    }
                    
                   //quitamos roles
                    if($user != NULL)
                    {
                                   
                      $user->removeRole($roles[$cont-1]);
                      $userManager->updateUser($user);
                    }
                    
                    
                }
                $cont++;
            }
            
            $em->commit();
            $return=array("responseCode"=>200, "greeting"=>"OK");
            
        } catch (Exception $ex) {

            $em->rollback();
            $return=array("responseCode"=>400, "greeting"=>"Bad");
            
        }
        //$em->clear();
        //$em->close();

        return new JsonResponse($return);
    }
}

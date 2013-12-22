<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\EnviaBundle\Controller;

/**
 * Description of BuzonController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\AplicacionCelula;
use AE\DataBundle\Entity\AsistenciaCelula;

class BuzonController extends Controller {
    //put your code here
    public function viewAction()
    {
        return $this->render('AEEnviaBundle:Default:buzon.html.twig');
    }
    
    public function asistenciaAction()
    {
         //aun sin guardar archivo
        
        $request = $this->get('request');
        $datos =$request->request->get('formulario');
        $asistencias = $request->request->get('en');
        
        $return = array();
        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            
            $id = $datos['asistencia_id'];
            
            $fech_b = $datos['aplicacion'];            
            $fech_a =explode('/', $fech_b,3);
            $fecha = $fech_a[2].'-'.$fech_a[1].'-'.$fech_a[0]; 
            
            $ofren = $datos['ofrenda'];
            $invitados = $datos['invitados'];
            
            //registramos la ofrenda
            
            $ofrenda = new \AE\DataBundle\Entity\Ofrendas();
            $ofrenda->setDecOfrendaFecharegistro(new \DateTime($fecha));
            $ofrenda->setDecOfrendaMonto($ofren);
            
            $em->persist($ofrenda);
            
            //actualizamos la aplicacion
            $aplicacion = $em->getRepository('AEDataBundle:AplicacionCelula')->find($id);
            $aplicacion->setAplicacion(new \DateTime($fecha));
            $aplicacion->setOfrenda($ofrenda);
            $aplicacion->setInvitados($invitados);
            $em->persist($aplicacion);
            $em->flush();
            
            foreach ($asistencias as $as) {
                if($as['asistio'])
                {
                    $sql = "UPDATE asistencia_celula set asistio = :ast WHERE aplicacion_cell_id = :id";
                    $smt = $em->getConnection()->prepare($sql);
                    $smt->execute(array(':id'=>$as['id'],':ast'=>TRUE));
                }
            }
            $em->commit();
            $em->clear();
            
            $return=array("responseCode"=>200, "greeting"=>"Ok");
        } catch (Exception $ex) {

            $em->rollback();
            $em->clear();
            $em->close();
            $return=array("responseCode"=>400, "greeting"=>"Ok");
        }
        
        return new JsonResponse($return);
    }
}

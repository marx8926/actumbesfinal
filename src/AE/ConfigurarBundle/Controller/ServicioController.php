<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServicioController
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
use AE\DataBundle\Entity\Red;
use AE\DataBundle\Entity\Ubicacion;
use AE\DataBundle\Entity\Servicios;

class ServicioController extends Controller {
    //put your code here
    public function viewAction()
    {
        return $this->render('AEConfigurarBundle:Default:servicio.html.twig');
        
    }
    public function editAction()
    {
        
    }
    public function saveAction()
    {
        $request = $this->get('request');
        $datos =$request->request->get('formulario');        
        $em = $this->getDoctrine()->getManager();
        
        $em->beginTransaction();
        
        try{
            $servicio = new Servicios();
            
            $servicio->setIntServicioTipo($datos['tipo']);
            $servicio->setIntTurnoDia($datos['dia']);
            $servicio->setVarServicioNombre($datos['nombre']);
            $servicio->setVarTurnoHorainicio($datos['inicio']);
            $servicio->setVarTurnoHorafin($datos['fin']);
            
            $em->persist($servicio);
            $em->flush();
            
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

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ConsolidaBundle\Controller;

/**
 * Description of InformeController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class InformeController extends Controller {
    //put your code here
    
    public function resumido_viewAction()
    {
        return $this->render('AEEnviaBundle:Default:informeresumido.html.twig');
    }
    
    public function detallado_viewAction()
    {
        return $this->render('AEEnviaBundle:Default:informedetallado.html.twig');
    }
    
    public function anual_tri_viewAction()
    {
        return $this->render('AEEnviaBundle:Default:informe_anual_tri.html.twig');
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RedController
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

class RedController extends Controller {
    //put your code here
    public function red_viewAction()
    {
        return $this->render('AEConfigurarBundle:Default:redes.html.twig');
    }
    
    public function editarAction()
    {
        
    }
    
    public function informacionAction()
    {
        return $this->render('AEConfigurarBundle:Default:informacion_red.html.twig');
    }
}

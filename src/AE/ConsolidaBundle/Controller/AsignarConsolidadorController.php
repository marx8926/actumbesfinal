<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ConsolidaBundle\Controller;

/**
 * Description of AsignarConsolidadorController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;

class AsignarConsolidadorController extends Controller {
    //put your code here
    public function viewAction()
    {
        return $this->render('AEConsolidaBundle:Default:asignarconsolidador.html.twig');
    }
    
    public function saveAction()
    {
        
    }
    
    public function editAction()
    {
        
    }
}

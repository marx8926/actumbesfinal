<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\GanaBundle\Controller;

/**
 * Description of DashboardController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEGanaBundle:Default:dashboard.html.twig');
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\DiscipulaBundle\Controller;

/**
 * Description of EstudianteController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;

class EstudianteController extends Controller {
    //put your code here
    
       
    public function viewAction()
    {
       return $this->render('AEDiscipulaBundle:Default:estudiante.html.twig');
    }
    
    public function editAction()
    {
        
    }
    public function saveAction()
    {
        
    }
    
    public function deleteAction()
    {
        
    }
}

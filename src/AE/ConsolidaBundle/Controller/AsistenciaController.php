<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ConsolidaBundle\Controller;

/**
 * Description of AsistenciaController
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AsistenciaController extends Controller {
    //put your code here
    
    public function viewAction()
    {
        return $this->render('AEConsolidaBundle:Default:asistencia.html.twig');
    }
}

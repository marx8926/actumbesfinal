<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ContabilidadBundle\Controller;

/**
 * Description of BuzonController
 *
 * @author Marks-Calderon
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BuzonController extends Controller {
    //put your code here
    public function viewAction()
    {
        return $this->render('AEContabilidadBundle:Default:buzon.html.twig');
    }
}

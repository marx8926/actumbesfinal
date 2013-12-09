<?php

namespace AE\GanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AEGanaBundle:Default:index.html.twig', array('name' => $name));
    }
}

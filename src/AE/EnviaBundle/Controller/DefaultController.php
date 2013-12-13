<?php

namespace AE\EnviaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AEEnviaBundle:Default:index.html.twig', array('name' => $name));
    }
}

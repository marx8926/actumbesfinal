<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ServiciosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Description of SecretariaServicioController
 *
 * @author Marks-Calderon
 */
class SecretariaServicioController extends Controller{
    //put your code here
    public function bautizo_allAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
	
		$sql = "select * from view_get_all_bautizo";
	
		$smt = $em->getConnection()->prepare($sql);
		$smt->execute();
	
		$todo = $smt->fetchAll();
	                
		return new JsonResponse(array('aaData'=>$todo));
    }
}

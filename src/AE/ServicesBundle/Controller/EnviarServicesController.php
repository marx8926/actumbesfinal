<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AE\ServicesBundle\Controller;

/**
 * Description of EnviarServices
 *
 * @author Marks-Calderon
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Security\Core\SecurityContext;
use AE\DataBundle\Entity\Red;
use AE\DataBundle\Entity\Celula;
use AE\DataBundle\Entity\Ubicacion;

class EnviarServicesController extends Controller {
    //put your code here
    
    public function ultimas_celula_tableAction()
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_view_last_celulas";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData' =>$result));
            
        return $resultado;
    }
    
    public function check_lider_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_check_liderred_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetch();        
        $resultado= new JsonResponse($result);
            
        return $resultado;
    }
    
    public function hijos_de_lider_optionAction($lider, $tipo)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_padre_hijo_nivel(:padre,:tipo)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':padre'=>$lider, ':tipo'=>$tipo));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);
        $resultado->setMaxAge(60);
        $resultado->setPublic();
            
        return $resultado;
    }
    
    public function all_celulas_red_tablaAction($red)
    {
                
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_celulas_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData'=>$result));
        $resultado->setMaxAge(60);
        $resultado->setPublic();
        return $resultado;
    }
    
    public function all_celulas_persona_tablaAction($persona)
    {
                
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_celulas_persona(:persona)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':persona'=>$persona));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData'=>$result));
        $resultado->setMaxAge(60);
        $resultado->setPublic();
        return $resultado;
    }
    
    public function sin_celula_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_sin_celula_option(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);            
        return $resultado;
    }
    
     public function con_celula_redAction($red, $celula)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_con_celula_option(:red,:celula)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red,':celula'=>$celula));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);            
        return $resultado;
    }
    
    public function celulas_menosAction($red, $celula, $tipo)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_celula_tipo_excepto_option(:red,:cell,:tipo)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red,':cell'=>$celula,':tipo'=>$tipo));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);            
        return $resultado;
    }
    
    public function tema_celulas_tablaAction()
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "SELECT *  FROM view_get_all_temas_celulas_table";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute();
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData'=>$result));            
        return $resultado;
    }
    
    public function aplicacion_inbox_tema_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_nuevas_aplicaciones_celula_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData'=>$result));            
        return $resultado;
    }
    
    public function aplicacion_sent_tema_redAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_sent_aplicaciones_celula_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData'=>$result));            
        return $resultado;
    }
    
    public function aplicacion_inbox_tema_red_personaAction($red, $persona)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_nuevas_aplicaciones_celula_red_persona(:red,:lid)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red, ':lid'=>$persona));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData'=>$result));            
        return $resultado;
    }
    
    public function aplicacion_sent_tema_red_personaAction($red, $persona)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_sent_aplicaciones_celula_lider(:red,:lid)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red,':lid'=>$persona));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData'=>$result));            
        return $resultado;
    }
    
    
    public function aplicacion_asistenciaAction($app)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_asistencia_aplicacion_celula(:app)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':app'=>$app));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse(array('aaData'=>$result));            
        return $resultado;
    }
    
    public function lidered_xred_optionAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_lideres_xred(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);            
        return $resultado;
    }
    
    public function arbol_liderazgo_xredAction($red)
    {
        $em = $this->getDoctrine()->getManager();        
        $sql = "select * from get_arbol_liderazgo_red(:red)";        
        $smt = $em->getConnection()->prepare($sql);
        $smt->execute(array(':red'=>$red));
        $result = $smt->fetchAll();        
        $resultado= new JsonResponse($result);            
        return $resultado;
    }
}

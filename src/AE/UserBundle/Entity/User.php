<?php
// src/Dicars/UserBundle/Entity/User.php

namespace AE\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use AE\DataBundle\Entity\Persona;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ae_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
      /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id")
     * })
     */
    private $idPersona;
   
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
    /**
     * Set idPersona
     *
     * @param \AE\DataBundle\Entity\Persona $idPersona
     * @return AeUser
     */
    public function setIdPersona(\AE\DataBundle\Entity\Persona $idPersona = null)
    {
        $this->idPersona = $idPersona;
    
        return $this;
    }

    /**
     * Get idPersona
     *
     * @return \AE\DataBundle\Entity\Persona 
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }
  
}
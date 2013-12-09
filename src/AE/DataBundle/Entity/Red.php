<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Red
 *
 * @ORM\Table(name="red")
 * @ORM\Entity
 */
class Red
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_red_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="red_int_red_id_seq", allocationSize=1, initialValue=1)
     */
    private $intRedId;

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=10, nullable=true)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ubigeo", type="integer", nullable=true)
     */
    private $idUbigeo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date", nullable=true)
     */
    private $inicio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;



    /**
     * Get intRedId
     *
     * @return integer 
     */
    public function getIntRedId()
    {
        return $this->intRedId;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Red
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idUbigeo
     *
     * @param integer $idUbigeo
     * @return Red
     */
    public function setIdUbigeo($idUbigeo)
    {
        $this->idUbigeo = $idUbigeo;
    
        return $this;
    }

    /**
     * Get idUbigeo
     *
     * @return integer 
     */
    public function getIdUbigeo()
    {
        return $this->idUbigeo;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return Red
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    
        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime 
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Red
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
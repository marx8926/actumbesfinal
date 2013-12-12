<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lider
 *
 * @ORM\Table(name="lider")
 * @ORM\Entity
 */
class Lider
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_lider_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lider_int_lider_id_seq", allocationSize=1, initialValue=1)
     */
    private $intLiderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_lider_12", type="integer", nullable=true)
     */
    private $intLider12;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_lider_144", type="integer", nullable=true)
     */
    private $intLider144;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_lider_1728", type="integer", nullable=true)
     */
    private $intLider1728;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_lider_20736", type="integer", nullable=true)
     */
    private $intLider20736;

    /**
     * @var integer
     *
     * @ORM\Column(name="pastor_id", type="bigint", nullable=true)
     */
    private $pastorId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="bigint", nullable=true)
     */
    private $dependencia;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * })
     */
    private $persona;



    /**
     * Get intLiderId
     *
     * @return integer 
     */
    public function getIntLiderId()
    {
        return $this->intLiderId;
    }

    /**
     * Set intLider12
     *
     * @param integer $intLider12
     * @return Lider
     */
    public function setIntLider12($intLider12)
    {
        $this->intLider12 = $intLider12;
    
        return $this;
    }

    /**
     * Get intLider12
     *
     * @return integer 
     */
    public function getIntLider12()
    {
        return $this->intLider12;
    }

    /**
     * Set intLider144
     *
     * @param integer $intLider144
     * @return Lider
     */
    public function setIntLider144($intLider144)
    {
        $this->intLider144 = $intLider144;
    
        return $this;
    }

    /**
     * Get intLider144
     *
     * @return integer 
     */
    public function getIntLider144()
    {
        return $this->intLider144;
    }

    /**
     * Set intLider1728
     *
     * @param integer $intLider1728
     * @return Lider
     */
    public function setIntLider1728($intLider1728)
    {
        $this->intLider1728 = $intLider1728;
    
        return $this;
    }

    /**
     * Get intLider1728
     *
     * @return integer 
     */
    public function getIntLider1728()
    {
        return $this->intLider1728;
    }

    /**
     * Set intLider20736
     *
     * @param integer $intLider20736
     * @return Lider
     */
    public function setIntLider20736($intLider20736)
    {
        $this->intLider20736 = $intLider20736;
    
        return $this;
    }

    /**
     * Get intLider20736
     *
     * @return integer 
     */
    public function getIntLider20736()
    {
        return $this->intLider20736;
    }

    /**
     * Set pastorId
     *
     * @param integer $pastorId
     * @return Lider
     */
    public function setPastorId($pastorId)
    {
        $this->pastorId = $pastorId;
    
        return $this;
    }

    /**
     * Get pastorId
     *
     * @return integer 
     */
    public function getPastorId()
    {
        return $this->pastorId;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Lider
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Lider
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

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     * @return Lider
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;
    
        return $this;
    }

    /**
     * Get dependencia
     *
     * @return integer 
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set persona
     *
     * @param \AE\DataBundle\Entity\Persona $persona
     * @return Lider
     */
    public function setPersona(\AE\DataBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;
    
        return $this;
    }

    /**
     * Get persona
     *
     * @return \AE\DataBundle\Entity\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }
}
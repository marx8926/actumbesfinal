<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NivelCrecimiento
 *
 * @ORM\Table(name="nivel_crecimiento")
 * @ORM\Entity
 */
class NivelCrecimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_nivelcrecimiento_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="nivel_crecimiento_int_nivelcrecimiento_id_seq", allocationSize=1, initialValue=1)
     */
    private $intNivelcrecimientoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_nivelcrecimiento_escala", type="integer", nullable=true)
     */
    private $intNivelcrecimientoEscala;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_nivelcrecimiento_estadoactual", type="integer", nullable=true)
     */
    private $intNivelcrecimientoEstadoactual;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creacion", type="date", nullable=true)
     */
    private $creacion;

    /**
     * @var \Red
     *
     * @ORM\ManyToOne(targetEntity="Red")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="red_id", referencedColumnName="int_red_id")
     * })
     */
    private $red;

    /**
     * @var \Celula
     *
     * @ORM\ManyToOne(targetEntity="Celula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="celula_id", referencedColumnName="id")
     * })
     */
    private $celula;

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
     * Get intNivelcrecimientoId
     *
     * @return integer 
     */
    public function getIntNivelcrecimientoId()
    {
        return $this->intNivelcrecimientoId;
    }

    /**
     * Set intNivelcrecimientoEscala
     *
     * @param integer $intNivelcrecimientoEscala
     * @return NivelCrecimiento
     */
    public function setIntNivelcrecimientoEscala($intNivelcrecimientoEscala)
    {
        $this->intNivelcrecimientoEscala = $intNivelcrecimientoEscala;
    
        return $this;
    }

    /**
     * Get intNivelcrecimientoEscala
     *
     * @return integer 
     */
    public function getIntNivelcrecimientoEscala()
    {
        return $this->intNivelcrecimientoEscala;
    }

    /**
     * Set intNivelcrecimientoEstadoactual
     *
     * @param integer $intNivelcrecimientoEstadoactual
     * @return NivelCrecimiento
     */
    public function setIntNivelcrecimientoEstadoactual($intNivelcrecimientoEstadoactual)
    {
        $this->intNivelcrecimientoEstadoactual = $intNivelcrecimientoEstadoactual;
    
        return $this;
    }

    /**
     * Get intNivelcrecimientoEstadoactual
     *
     * @return integer 
     */
    public function getIntNivelcrecimientoEstadoactual()
    {
        return $this->intNivelcrecimientoEstadoactual;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     * @return NivelCrecimiento
     */
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;
    
        return $this;
    }

    /**
     * Get creacion
     *
     * @return \DateTime 
     */
    public function getCreacion()
    {
        return $this->creacion;
    }

    /**
     * Set red
     *
     * @param \AE\DataBundle\Entity\Red $red
     * @return NivelCrecimiento
     */
    public function setRed(\AE\DataBundle\Entity\Red $red = null)
    {
        $this->red = $red;
    
        return $this;
    }

    /**
     * Get red
     *
     * @return \AE\DataBundle\Entity\Red 
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * Set celula
     *
     * @param \AE\DataBundle\Entity\Celula $celula
     * @return NivelCrecimiento
     */
    public function setCelula(\AE\DataBundle\Entity\Celula $celula = null)
    {
        $this->celula = $celula;
    
        return $this;
    }

    /**
     * Get celula
     *
     * @return \AE\DataBundle\Entity\Celula 
     */
    public function getCelula()
    {
        return $this->celula;
    }

    /**
     * Set persona
     *
     * @param \AE\DataBundle\Entity\Persona $persona
     * @return NivelCrecimiento
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
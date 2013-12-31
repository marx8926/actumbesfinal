<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Red
 *
 * @ORM\Table(name="red", indexes={@ORM\Index(name="fki_lider_red", columns={"lider"}), @ORM\Index(name="IDX_FA615F8F5C20309F", columns={"id_ubicacion"})})
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
     * @var integer
     *
     * @ORM\Column(name="pastor", type="bigint", nullable=true)
     */
    private $pastor;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=10, nullable=true)
     */
    private $color = '#41690';

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lider", referencedColumnName="id")
     * })
     */
    private $lider;

    /**
     * @var \Ubicacion
     *
     * @ORM\ManyToOne(targetEntity="Ubicacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ubicacion", referencedColumnName="id")
     * })
     */
    private $idUbicacion;



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

    /**
     * Set pastor
     *
     * @param integer $pastor
     * @return Red
     */
    public function setPastor($pastor)
    {
        $this->pastor = $pastor;

        return $this;
    }

    /**
     * Get pastor
     *
     * @return integer 
     */
    public function getPastor()
    {
        return $this->pastor;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Red
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Red
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set lider
     *
     * @param \AE\DataBundle\Entity\Persona $lider
     * @return Red
     */
    public function setLider(\AE\DataBundle\Entity\Persona $lider = null)
    {
        $this->lider = $lider;

        return $this;
    }

    /**
     * Get lider
     *
     * @return \AE\DataBundle\Entity\Persona 
     */
    public function getLider()
    {
        return $this->lider;
    }

    /**
     * Set idUbicacion
     *
     * @param \AE\DataBundle\Entity\Ubicacion $idUbicacion
     * @return Red
     */
    public function setIdUbicacion(\AE\DataBundle\Entity\Ubicacion $idUbicacion = null)
    {
        $this->idUbicacion = $idUbicacion;

        return $this;
    }

    /**
     * Get idUbicacion
     *
     * @return \AE\DataBundle\Entity\Ubicacion 
     */
    public function getIdUbicacion()
    {
        return $this->idUbicacion;
    }
}

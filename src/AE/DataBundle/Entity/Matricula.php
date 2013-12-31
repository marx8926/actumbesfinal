<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matricula
 *
 * @ORM\Table(name="matricula", indexes={@ORM\Index(name="fki_detalle_pca", columns={"detalle_pca"}), @ORM\Index(name="IDX_15DF188559590C39", columns={"estudiante_id"})})
 * @ORM\Entity
 */
class Matricula
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="matricula_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado = 'true';

    /**
     * @var boolean
     *
     * @ORM\Column(name="aprobado", type="boolean", nullable=true)
     */
    private $aprobado = 'false';

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estudiante_id", referencedColumnName="id")
     * })
     */
    private $estudiante;

    /**
     * @var \DetallePca
     *
     * @ORM\ManyToOne(targetEntity="DetallePca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="detalle_pca", referencedColumnName="id")
     * })
     */
    private $detallePca;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Matricula
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Matricula
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Matricula
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set aprobado
     *
     * @param boolean $aprobado
     * @return Matricula
     */
    public function setAprobado($aprobado)
    {
        $this->aprobado = $aprobado;

        return $this;
    }

    /**
     * Get aprobado
     *
     * @return boolean 
     */
    public function getAprobado()
    {
        return $this->aprobado;
    }

    /**
     * Set estudiante
     *
     * @param \AE\DataBundle\Entity\Persona $estudiante
     * @return Matricula
     */
    public function setEstudiante(\AE\DataBundle\Entity\Persona $estudiante = null)
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    /**
     * Get estudiante
     *
     * @return \AE\DataBundle\Entity\Persona 
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * Set detallePca
     *
     * @param \AE\DataBundle\Entity\DetallePca $detallePca
     * @return Matricula
     */
    public function setDetallePca(\AE\DataBundle\Entity\DetallePca $detallePca = null)
    {
        $this->detallePca = $detallePca;

        return $this;
    }

    /**
     * Get detallePca
     *
     * @return \AE\DataBundle\Entity\DetallePca 
     */
    public function getDetallePca()
    {
        return $this->detallePca;
    }
}

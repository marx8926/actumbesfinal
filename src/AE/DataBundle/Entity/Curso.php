<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Curso
 *
 * @ORM\Table(name="curso", indexes={@ORM\Index(name="fki_requisito_curso", columns={"requisito_id"})})
 * @ORM\Entity
 */
class Curso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="curso_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_sesiones", type="smallint", nullable=false)
     */
    private $numeroSesiones;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo = 'true';

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=120, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviatura", type="string", length=5, nullable=true)
     */
    private $abreviatura;

    /**
     * @var \Curso
     *
     * @ORM\ManyToOne(targetEntity="Curso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="requisito_id", referencedColumnName="id")
     * })
     */
    private $requisito;



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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Curso
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Curso
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set numeroSesiones
     *
     * @param integer $numeroSesiones
     * @return Curso
     */
    public function setNumeroSesiones($numeroSesiones)
    {
        $this->numeroSesiones = $numeroSesiones;

        return $this;
    }

    /**
     * Get numeroSesiones
     *
     * @return integer 
     */
    public function getNumeroSesiones()
    {
        return $this->numeroSesiones;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Curso
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
     * Set titulo
     *
     * @param string $titulo
     * @return Curso
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set abreviatura
     *
     * @param string $abreviatura
     * @return Curso
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string 
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set requisito
     *
     * @param \AE\DataBundle\Entity\Curso $requisito
     * @return Curso
     */
    public function setRequisito(\AE\DataBundle\Entity\Curso $requisito = null)
    {
        $this->requisito = $requisito;

        return $this;
    }

    /**
     * Get requisito
     *
     * @return \AE\DataBundle\Entity\Curso 
     */
    public function getRequisito()
    {
        return $this->requisito;
    }
}

<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Celula
 *
 * @ORM\Table(name="celula")
 * @ORM\Entity
 */
class Celula
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="celula_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="smallint", nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="familia", type="string", length=100, nullable=false)
     */
    private $familia;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable=true)
     */
    private $telefono;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ubicacion", type="bigint", nullable=false)
     */
    private $idUbicacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var string
     *
     * @ORM\Column(name="dia", type="string", length=25, nullable=true)
     */
    private $dia;

    /**
     * @var string
     *
     * @ORM\Column(name="hora", type="string", length=10, nullable=true)
     */
    private $hora;

    /**
     * @var \Red
     *
     * @ORM\ManyToOne(targetEntity="Red")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_red", referencedColumnName="int_red_id")
     * })
     */
    private $idRed;



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
     * @return Celula
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
     * Set tipo
     *
     * @param integer $tipo
     * @return Celula
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
     * Set familia
     *
     * @param string $familia
     * @return Celula
     */
    public function setFamilia($familia)
    {
        $this->familia = $familia;
    
        return $this;
    }

    /**
     * Get familia
     *
     * @return string 
     */
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Celula
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set idUbicacion
     *
     * @param integer $idUbicacion
     * @return Celula
     */
    public function setIdUbicacion($idUbicacion)
    {
        $this->idUbicacion = $idUbicacion;
    
        return $this;
    }

    /**
     * Get idUbicacion
     *
     * @return integer 
     */
    public function getIdUbicacion()
    {
        return $this->idUbicacion;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Celula
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
     * Set dia
     *
     * @param string $dia
     * @return Celula
     */
    public function setDia($dia)
    {
        $this->dia = $dia;
    
        return $this;
    }

    /**
     * Get dia
     *
     * @return string 
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set hora
     *
     * @param string $hora
     * @return Celula
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    
        return $this;
    }

    /**
     * Get hora
     *
     * @return string 
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set idRed
     *
     * @param \AE\DataBundle\Entity\Red $idRed
     * @return Celula
     */
    public function setIdRed(\AE\DataBundle\Entity\Red $idRed = null)
    {
        $this->idRed = $idRed;
    
        return $this;
    }

    /**
     * Get idRed
     *
     * @return \AE\DataBundle\Entity\Red 
     */
    public function getIdRed()
    {
        return $this->idRed;
    }
}
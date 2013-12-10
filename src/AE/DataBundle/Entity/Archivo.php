<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archivo
 *
 * @ORM\Table(name="archivo")
 * @ORM\Entity
 */
class Archivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="archivo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text", nullable=false)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="peso", type="bigint", nullable=true)
     */
    private $peso;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=25, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=10, nullable=true)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="text", nullable=true)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tema_celula", type="integer", nullable=true)
     */
    private $idTemaCelula;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tema_curso", type="integer", nullable=true)
     */
    private $idTemaCurso;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_leche_espiritual", type="integer", nullable=true)
     */
    private $idLecheEspiritual;



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
     * Set direccion
     *
     * @param string $direccion
     * @return Archivo
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set peso
     *
     * @param integer $peso
     * @return Archivo
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    
        return $this;
    }

    /**
     * Get peso
     *
     * @return integer 
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Archivo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return Archivo
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    
        return $this;
    }

    /**
     * Get extension
     *
     * @return string 
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Archivo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Archivo
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
     * Set idTemaCelula
     *
     * @param integer $idTemaCelula
     * @return Archivo
     */
    public function setIdTemaCelula($idTemaCelula)
    {
        $this->idTemaCelula = $idTemaCelula;
    
        return $this;
    }

    /**
     * Get idTemaCelula
     *
     * @return integer 
     */
    public function getIdTemaCelula()
    {
        return $this->idTemaCelula;
    }

    /**
     * Set idTemaCurso
     *
     * @param integer $idTemaCurso
     * @return Archivo
     */
    public function setIdTemaCurso($idTemaCurso)
    {
        $this->idTemaCurso = $idTemaCurso;
    
        return $this;
    }

    /**
     * Get idTemaCurso
     *
     * @return integer 
     */
    public function getIdTemaCurso()
    {
        return $this->idTemaCurso;
    }

    /**
     * Set idLecheEspiritual
     *
     * @param integer $idLecheEspiritual
     * @return Archivo
     */
    public function setIdLecheEspiritual($idLecheEspiritual)
    {
        $this->idLecheEspiritual = $idLecheEspiritual;
    
        return $this;
    }

    /**
     * Get idLecheEspiritual
     *
     * @return integer 
     */
    public function getIdLecheEspiritual()
    {
        return $this->idLecheEspiritual;
    }
}
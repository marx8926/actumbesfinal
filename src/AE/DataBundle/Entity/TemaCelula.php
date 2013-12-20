<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TemaCelula
 *
 * @ORM\Table(name="tema_celula", indexes={@ORM\Index(name="fki_archivo", columns={"archivo_id"})})
 * @ORM\Entity
 */
class TemaCelula
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tema_celula_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titutlo", type="string", length=100, nullable=false)
     */
    private $titutlo;

    /**
     * @var string
     *
     * @ORM\Column(name="autor", type="string", length=70, nullable=false)
     */
    private $autor;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20, nullable=true)
     */
    private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="distribuido", type="date", nullable=true)
     */
    private $distribuido;

    /**
     * @var \Archivo
     *
     * @ORM\ManyToOne(targetEntity="Archivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="archivo_id", referencedColumnName="id")
     * })
     */
    private $archivo;



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
     * Set titutlo
     *
     * @param string $titutlo
     * @return TemaCelula
     */
    public function setTitutlo($titutlo)
    {
        $this->titutlo = $titutlo;

        return $this;
    }

    /**
     * Get titutlo
     *
     * @return string 
     */
    public function getTitutlo()
    {
        return $this->titutlo;
    }

    /**
     * Set autor
     *
     * @param string $autor
     * @return TemaCelula
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string 
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return TemaCelula
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return TemaCelula
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
     * Set tipo
     *
     * @param string $tipo
     * @return TemaCelula
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
     * Set distribuido
     *
     * @param \DateTime $distribuido
     * @return TemaCelula
     */
    public function setDistribuido($distribuido)
    {
        $this->distribuido = $distribuido;

        return $this;
    }

    /**
     * Get distribuido
     *
     * @return \DateTime 
     */
    public function getDistribuido()
    {
        return $this->distribuido;
    }

    /**
     * Set archivo
     *
     * @param \AE\DataBundle\Entity\Archivo $archivo
     * @return TemaCelula
     */
    public function setArchivo(\AE\DataBundle\Entity\Archivo $archivo = null)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return \AE\DataBundle\Entity\Archivo 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }
}

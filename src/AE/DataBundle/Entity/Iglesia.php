<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Iglesia
 *
 * @ORM\Table(name="iglesia")
 * @ORM\Entity
 */
class Iglesia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_iglesia_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="iglesia_int_iglesia_id_seq", allocationSize=1, initialValue=1)
     */
    private $intIglesiaId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_iglesia_fecregistro", type="time", nullable=true)
     */
    private $datIglesiaFecregistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_iglesia_fecreacion", type="date", nullable=true)
     */
    private $datIglesiaFecreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="var_iglesia_telefono", type="string", nullable=true)
     */
    private $varIglesiaTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="var_iglesia_siglas", type="string", nullable=true)
     */
    private $varIglesiaSiglas;

    /**
     * @var string
     *
     * @ORM\Column(name="var_iglesia_nombre", type="string", nullable=true)
     */
    private $varIglesiaNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="var_iglesia_direccion", type="string", nullable=true)
     */
    private $varIglesiaDireccion;

    /**
     * @var string
     *
     * @ORM\Column(name="var_iglesia_referencia", type="string", nullable=true)
     */
    private $varIglesiaReferencia;

    /**
     * @var float
     *
     * @ORM\Column(name="dou_iglesia_longitud", type="float", nullable=true)
     */
    private $douIglesiaLongitud;

    /**
     * @var float
     *
     * @ORM\Column(name="dou_iglesia_latitud", type="float", nullable=true)
     */
    private $douIglesiaLatitud;

    /**
     * @var \Ubigeos
     *
     * @ORM\ManyToOne(targetEntity="Ubigeos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ubigeo_id", referencedColumnName="int_ubigeo_id")
     * })
     */
    private $ubigeo;



    /**
     * Get intIglesiaId
     *
     * @return integer 
     */
    public function getIntIglesiaId()
    {
        return $this->intIglesiaId;
    }

    /**
     * Set datIglesiaFecregistro
     *
     * @param \DateTime $datIglesiaFecregistro
     * @return Iglesia
     */
    public function setDatIglesiaFecregistro($datIglesiaFecregistro)
    {
        $this->datIglesiaFecregistro = $datIglesiaFecregistro;
    
        return $this;
    }

    /**
     * Get datIglesiaFecregistro
     *
     * @return \DateTime 
     */
    public function getDatIglesiaFecregistro()
    {
        return $this->datIglesiaFecregistro;
    }

    /**
     * Set datIglesiaFecreacion
     *
     * @param \DateTime $datIglesiaFecreacion
     * @return Iglesia
     */
    public function setDatIglesiaFecreacion($datIglesiaFecreacion)
    {
        $this->datIglesiaFecreacion = $datIglesiaFecreacion;
    
        return $this;
    }

    /**
     * Get datIglesiaFecreacion
     *
     * @return \DateTime 
     */
    public function getDatIglesiaFecreacion()
    {
        return $this->datIglesiaFecreacion;
    }

    /**
     * Set varIglesiaTelefono
     *
     * @param string $varIglesiaTelefono
     * @return Iglesia
     */
    public function setVarIglesiaTelefono($varIglesiaTelefono)
    {
        $this->varIglesiaTelefono = $varIglesiaTelefono;
    
        return $this;
    }

    /**
     * Get varIglesiaTelefono
     *
     * @return string 
     */
    public function getVarIglesiaTelefono()
    {
        return $this->varIglesiaTelefono;
    }

    /**
     * Set varIglesiaSiglas
     *
     * @param string $varIglesiaSiglas
     * @return Iglesia
     */
    public function setVarIglesiaSiglas($varIglesiaSiglas)
    {
        $this->varIglesiaSiglas = $varIglesiaSiglas;
    
        return $this;
    }

    /**
     * Get varIglesiaSiglas
     *
     * @return string 
     */
    public function getVarIglesiaSiglas()
    {
        return $this->varIglesiaSiglas;
    }

    /**
     * Set varIglesiaNombre
     *
     * @param string $varIglesiaNombre
     * @return Iglesia
     */
    public function setVarIglesiaNombre($varIglesiaNombre)
    {
        $this->varIglesiaNombre = $varIglesiaNombre;
    
        return $this;
    }

    /**
     * Get varIglesiaNombre
     *
     * @return string 
     */
    public function getVarIglesiaNombre()
    {
        return $this->varIglesiaNombre;
    }

    /**
     * Set varIglesiaDireccion
     *
     * @param string $varIglesiaDireccion
     * @return Iglesia
     */
    public function setVarIglesiaDireccion($varIglesiaDireccion)
    {
        $this->varIglesiaDireccion = $varIglesiaDireccion;
    
        return $this;
    }

    /**
     * Get varIglesiaDireccion
     *
     * @return string 
     */
    public function getVarIglesiaDireccion()
    {
        return $this->varIglesiaDireccion;
    }

    /**
     * Set varIglesiaReferencia
     *
     * @param string $varIglesiaReferencia
     * @return Iglesia
     */
    public function setVarIglesiaReferencia($varIglesiaReferencia)
    {
        $this->varIglesiaReferencia = $varIglesiaReferencia;
    
        return $this;
    }

    /**
     * Get varIglesiaReferencia
     *
     * @return string 
     */
    public function getVarIglesiaReferencia()
    {
        return $this->varIglesiaReferencia;
    }

    /**
     * Set douIglesiaLongitud
     *
     * @param float $douIglesiaLongitud
     * @return Iglesia
     */
    public function setDouIglesiaLongitud($douIglesiaLongitud)
    {
        $this->douIglesiaLongitud = $douIglesiaLongitud;
    
        return $this;
    }

    /**
     * Get douIglesiaLongitud
     *
     * @return float 
     */
    public function getDouIglesiaLongitud()
    {
        return $this->douIglesiaLongitud;
    }

    /**
     * Set douIglesiaLatitud
     *
     * @param float $douIglesiaLatitud
     * @return Iglesia
     */
    public function setDouIglesiaLatitud($douIglesiaLatitud)
    {
        $this->douIglesiaLatitud = $douIglesiaLatitud;
    
        return $this;
    }

    /**
     * Get douIglesiaLatitud
     *
     * @return float 
     */
    public function getDouIglesiaLatitud()
    {
        return $this->douIglesiaLatitud;
    }

    /**
     * Set ubigeo
     *
     * @param \AE\DataBundle\Entity\Ubigeos $ubigeo
     * @return Iglesia
     */
    public function setUbigeo(\AE\DataBundle\Entity\Ubigeos $ubigeo = null)
    {
        $this->ubigeo = $ubigeo;
    
        return $this;
    }

    /**
     * Get ubigeo
     *
     * @return \AE\DataBundle\Entity\Ubigeos 
     */
    public function getUbigeo()
    {
        return $this->ubigeo;
    }
}
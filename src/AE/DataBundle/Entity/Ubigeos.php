<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ubigeos
 *
 * @ORM\Table(name="ubigeos")
 * @ORM\Entity
 */
class Ubigeos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_ubigeo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ubigeos_int_ubigeo_id_seq", allocationSize=1, initialValue=1)
     */
    private $intUbigeoId;

    /**
     * @var string
     *
     * @ORM\Column(name="string_ubigeo_descripcion", type="string", length=50, nullable=true)
     */
    private $stringUbigeoDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_ubigeo_departamento", type="integer", nullable=true)
     */
    private $intUbigeoDepartamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_ubigeo_provincia", type="integer", nullable=true)
     */
    private $intUbigeoProvincia;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_ubigeo_distrito", type="integer", nullable=true)
     */
    private $intUbigeoDistrito;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_ubigeo_dependencia", type="integer", nullable=true)
     */
    private $intUbigeoDependencia;

    /**
     * @var float
     *
     * @ORM\Column(name="float_ubigeo_latitud", type="float", nullable=true)
     */
    private $floatUbigeoLatitud;

    /**
     * @var float
     *
     * @ORM\Column(name="float_ubigeo_longitud", type="float", nullable=true)
     */
    private $floatUbigeoLongitud;



    /**
     * Get intUbigeoId
     *
     * @return integer 
     */
    public function getIntUbigeoId()
    {
        return $this->intUbigeoId;
    }

    /**
     * Set stringUbigeoDescripcion
     *
     * @param string $stringUbigeoDescripcion
     * @return Ubigeos
     */
    public function setStringUbigeoDescripcion($stringUbigeoDescripcion)
    {
        $this->stringUbigeoDescripcion = $stringUbigeoDescripcion;
    
        return $this;
    }

    /**
     * Get stringUbigeoDescripcion
     *
     * @return string 
     */
    public function getStringUbigeoDescripcion()
    {
        return $this->stringUbigeoDescripcion;
    }

    /**
     * Set intUbigeoDepartamento
     *
     * @param integer $intUbigeoDepartamento
     * @return Ubigeos
     */
    public function setIntUbigeoDepartamento($intUbigeoDepartamento)
    {
        $this->intUbigeoDepartamento = $intUbigeoDepartamento;
    
        return $this;
    }

    /**
     * Get intUbigeoDepartamento
     *
     * @return integer 
     */
    public function getIntUbigeoDepartamento()
    {
        return $this->intUbigeoDepartamento;
    }

    /**
     * Set intUbigeoProvincia
     *
     * @param integer $intUbigeoProvincia
     * @return Ubigeos
     */
    public function setIntUbigeoProvincia($intUbigeoProvincia)
    {
        $this->intUbigeoProvincia = $intUbigeoProvincia;
    
        return $this;
    }

    /**
     * Get intUbigeoProvincia
     *
     * @return integer 
     */
    public function getIntUbigeoProvincia()
    {
        return $this->intUbigeoProvincia;
    }

    /**
     * Set intUbigeoDistrito
     *
     * @param integer $intUbigeoDistrito
     * @return Ubigeos
     */
    public function setIntUbigeoDistrito($intUbigeoDistrito)
    {
        $this->intUbigeoDistrito = $intUbigeoDistrito;
    
        return $this;
    }

    /**
     * Get intUbigeoDistrito
     *
     * @return integer 
     */
    public function getIntUbigeoDistrito()
    {
        return $this->intUbigeoDistrito;
    }

    /**
     * Set intUbigeoDependencia
     *
     * @param integer $intUbigeoDependencia
     * @return Ubigeos
     */
    public function setIntUbigeoDependencia($intUbigeoDependencia)
    {
        $this->intUbigeoDependencia = $intUbigeoDependencia;
    
        return $this;
    }

    /**
     * Get intUbigeoDependencia
     *
     * @return integer 
     */
    public function getIntUbigeoDependencia()
    {
        return $this->intUbigeoDependencia;
    }

    /**
     * Set floatUbigeoLatitud
     *
     * @param float $floatUbigeoLatitud
     * @return Ubigeos
     */
    public function setFloatUbigeoLatitud($floatUbigeoLatitud)
    {
        $this->floatUbigeoLatitud = $floatUbigeoLatitud;
    
        return $this;
    }

    /**
     * Get floatUbigeoLatitud
     *
     * @return float 
     */
    public function getFloatUbigeoLatitud()
    {
        return $this->floatUbigeoLatitud;
    }

    /**
     * Set floatUbigeoLongitud
     *
     * @param float $floatUbigeoLongitud
     * @return Ubigeos
     */
    public function setFloatUbigeoLongitud($floatUbigeoLongitud)
    {
        $this->floatUbigeoLongitud = $floatUbigeoLongitud;
    
        return $this;
    }

    /**
     * Get floatUbigeoLongitud
     *
     * @return float 
     */
    public function getFloatUbigeoLongitud()
    {
        return $this->floatUbigeoLongitud;
    }
}
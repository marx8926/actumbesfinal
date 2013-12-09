<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lugar
 *
 * @ORM\Table(name="lugar")
 * @ORM\Entity
 */
class Lugar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_lugar_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lugar_int_lugar_id_seq", allocationSize=1, initialValue=1)
     */
    private $intLugarId;

    /**
     * @var string
     *
     * @ORM\Column(name="var_lugar_descripcion", type="string", length=100, nullable=true)
     */
    private $varLugarDescripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="var_lugar_estado", type="string", length=1, nullable=true)
     */
    private $varLugarEstado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;



    /**
     * Get intLugarId
     *
     * @return integer 
     */
    public function getIntLugarId()
    {
        return $this->intLugarId;
    }

    /**
     * Set varLugarDescripcion
     *
     * @param string $varLugarDescripcion
     * @return Lugar
     */
    public function setVarLugarDescripcion($varLugarDescripcion)
    {
        $this->varLugarDescripcion = $varLugarDescripcion;
    
        return $this;
    }

    /**
     * Get varLugarDescripcion
     *
     * @return string 
     */
    public function getVarLugarDescripcion()
    {
        return $this->varLugarDescripcion;
    }

    /**
     * Set varLugarEstado
     *
     * @param string $varLugarEstado
     * @return Lugar
     */
    public function setVarLugarEstado($varLugarEstado)
    {
        $this->varLugarEstado = $varLugarEstado;
    
        return $this;
    }

    /**
     * Get varLugarEstado
     *
     * @return string 
     */
    public function getVarLugarEstado()
    {
        return $this->varLugarEstado;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Lugar
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
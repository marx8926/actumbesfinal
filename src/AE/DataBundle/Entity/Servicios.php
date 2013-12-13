<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicios
 *
 * @ORM\Table(name="servicios")
 * @ORM\Entity
 */
class Servicios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_servicio_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="servicios_int_servicio_id_seq", allocationSize=1, initialValue=1)
     */
    private $intServicioId;

    /**
     * @var string
     *
     * @ORM\Column(name="var_servicio_nombre", type="string", length=150, nullable=true)
     */
    private $varServicioNombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_servicio_tipo", type="integer", nullable=true)
     */
    private $intServicioTipo;

    /**
     * @var string
     *
     * @ORM\Column(name="var_turno_horainicio", type="string", length=10, nullable=true)
     */
    private $varTurnoHorainicio;

    /**
     * @var string
     *
     * @ORM\Column(name="var_turno_horafin", type="string", length=10, nullable=true)
     */
    private $varTurnoHorafin;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_turno_dia", type="integer", nullable=true)
     */
    private $intTurnoDia;



    /**
     * Get intServicioId
     *
     * @return integer 
     */
    public function getIntServicioId()
    {
        return $this->intServicioId;
    }

    /**
     * Set varServicioNombre
     *
     * @param string $varServicioNombre
     * @return Servicios
     */
    public function setVarServicioNombre($varServicioNombre)
    {
        $this->varServicioNombre = $varServicioNombre;
    
        return $this;
    }

    /**
     * Get varServicioNombre
     *
     * @return string 
     */
    public function getVarServicioNombre()
    {
        return $this->varServicioNombre;
    }

    /**
     * Set intServicioTipo
     *
     * @param integer $intServicioTipo
     * @return Servicios
     */
    public function setIntServicioTipo($intServicioTipo)
    {
        $this->intServicioTipo = $intServicioTipo;
    
        return $this;
    }

    /**
     * Get intServicioTipo
     *
     * @return integer 
     */
    public function getIntServicioTipo()
    {
        return $this->intServicioTipo;
    }

    /**
     * Set varTurnoHorainicio
     *
     * @param string $varTurnoHorainicio
     * @return Servicios
     */
    public function setVarTurnoHorainicio($varTurnoHorainicio)
    {
        $this->varTurnoHorainicio = $varTurnoHorainicio;
    
        return $this;
    }

    /**
     * Get varTurnoHorainicio
     *
     * @return string 
     */
    public function getVarTurnoHorainicio()
    {
        return $this->varTurnoHorainicio;
    }

    /**
     * Set varTurnoHorafin
     *
     * @param string $varTurnoHorafin
     * @return Servicios
     */
    public function setVarTurnoHorafin($varTurnoHorafin)
    {
        $this->varTurnoHorafin = $varTurnoHorafin;
    
        return $this;
    }

    /**
     * Get varTurnoHorafin
     *
     * @return string 
     */
    public function getVarTurnoHorafin()
    {
        return $this->varTurnoHorafin;
    }

    /**
     * Set intTurnoDia
     *
     * @param integer $intTurnoDia
     * @return Servicios
     */
    public function setIntTurnoDia($intTurnoDia)
    {
        $this->intTurnoDia = $intTurnoDia;
    
        return $this;
    }

    /**
     * Get intTurnoDia
     *
     * @return integer 
     */
    public function getIntTurnoDia()
    {
        return $this->intTurnoDia;
    }
}
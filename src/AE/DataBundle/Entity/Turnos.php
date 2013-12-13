<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Turnos
 *
 * @ORM\Table(name="turnos")
 * @ORM\Entity
 */
class Turnos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="int_turno_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="turnos_int_turno_id_seq", allocationSize=1, initialValue=1)
     */
    private $intTurnoId;

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
     * @var \Servicios
     *
     * @ORM\ManyToOne(targetEntity="Servicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="servicio_id", referencedColumnName="int_servicio_id")
     * })
     */
    private $servicio;



    /**
     * Get intTurnoId
     *
     * @return integer 
     */
    public function getIntTurnoId()
    {
        return $this->intTurnoId;
    }

    /**
     * Set varTurnoHorainicio
     *
     * @param string $varTurnoHorainicio
     * @return Turnos
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
     * @return Turnos
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
     * @return Turnos
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

    /**
     * Set servicio
     *
     * @param \AE\DataBundle\Entity\Servicios $servicio
     * @return Turnos
     */
    public function setServicio(\AE\DataBundle\Entity\Servicios $servicio = null)
    {
        $this->servicio = $servicio;
    
        return $this;
    }

    /**
     * Get servicio
     *
     * @return \AE\DataBundle\Entity\Servicios 
     */
    public function getServicio()
    {
        return $this->servicio;
    }
}
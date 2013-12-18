<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsistenciaLeccionCurso
 *
 * @ORM\Table(name="asistencia_leccion_curso")
 * @ORM\Entity
 */
class AsistenciaLeccionCurso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="asistencia_leccion_curso_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="nota", type="integer", nullable=true)
     */
    private $nota;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asistencia", type="boolean", nullable=true)
     */
    private $asistencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="aplicacion", type="date", nullable=true)
     */
    private $aplicacion;

    /**
     * @var \Matricula
     *
     * @ORM\ManyToOne(targetEntity="Matricula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matricula_id", referencedColumnName="id")
     * })
     */
    private $matricula;

    /**
     * @var \TemaCurso
     *
     * @ORM\ManyToOne(targetEntity="TemaCurso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="leccion_id", referencedColumnName="id")
     * })
     */
    private $leccion;



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
     * Set nota
     *
     * @param integer $nota
     * @return AsistenciaLeccionCurso
     */
    public function setNota($nota)
    {
        $this->nota = $nota;
    
        return $this;
    }

    /**
     * Get nota
     *
     * @return integer 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set asistencia
     *
     * @param boolean $asistencia
     * @return AsistenciaLeccionCurso
     */
    public function setAsistencia($asistencia)
    {
        $this->asistencia = $asistencia;
    
        return $this;
    }

    /**
     * Get asistencia
     *
     * @return boolean 
     */
    public function getAsistencia()
    {
        return $this->asistencia;
    }

    /**
     * Set aplicacion
     *
     * @param \DateTime $aplicacion
     * @return AsistenciaLeccionCurso
     */
    public function setAplicacion($aplicacion)
    {
        $this->aplicacion = $aplicacion;
    
        return $this;
    }

    /**
     * Get aplicacion
     *
     * @return \DateTime 
     */
    public function getAplicacion()
    {
        return $this->aplicacion;
    }

    /**
     * Set matricula
     *
     * @param \AE\DataBundle\Entity\Matricula $matricula
     * @return AsistenciaLeccionCurso
     */
    public function setMatricula(\AE\DataBundle\Entity\Matricula $matricula = null)
    {
        $this->matricula = $matricula;
    
        return $this;
    }

    /**
     * Get matricula
     *
     * @return \AE\DataBundle\Entity\Matricula 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set leccion
     *
     * @param \AE\DataBundle\Entity\TemaCurso $leccion
     * @return AsistenciaLeccionCurso
     */
    public function setLeccion(\AE\DataBundle\Entity\TemaCurso $leccion = null)
    {
        $this->leccion = $leccion;
    
        return $this;
    }

    /**
     * Get leccion
     *
     * @return \AE\DataBundle\Entity\TemaCurso 
     */
    public function getLeccion()
    {
        return $this->leccion;
    }
}
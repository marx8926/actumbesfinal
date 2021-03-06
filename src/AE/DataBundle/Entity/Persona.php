<?php

namespace AE\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona", indexes={@ORM\Index(name="idx_apellidos", columns={"apellidos"}), @ORM\Index(name="fki_foto", columns={"foto"}), @ORM\Index(name="fki_ubicacion", columns={"id_ubicacion"}), @ORM\Index(name="fk_ganado_por", columns={"ganado_por"}), @ORM\Index(name="idx_nombres", columns={"nombre"}), @ORM\Index(name="IDX_51E5B69BC0298A8E", columns={"id_iglesia"}), @ORM\Index(name="IDX_51E5B69BB5A3803B", columns={"lugar_id"}), @ORM\Index(name="IDX_51E5B69B8BBE8922", columns={"red_id"})})
 * @ORM\Entity
 */
class Persona
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="persona_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=100, nullable=false)
     */
    private $apellidos;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_civil", type="smallint", nullable=false)
     */
    private $estadoCivil;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="smallint", nullable=false)
     */
    private $edad;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=20, nullable=true)
     */
    private $celular;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=100, nullable=true)
     */
    private $website;

    /**
     * @var integer
     *
     * @ORM\Column(name="sexo", type="smallint", nullable=false)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=10, nullable=true)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=150, nullable=true)
     */
    private $ocupacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo = 'true';

    /**
     * @var integer
     *
     * @ORM\Column(name="ganado_por", type="bigint", nullable=true)
     */
    private $ganadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="peticion", type="string", length=300, nullable=true)
     */
    private $peticion;

    /**
     * @var string
     *
     * @ORM\Column(name="dia", type="string", length=30, nullable=true)
     */
    private $dia;

    /**
     * @var string
     *
     * @ORM\Column(name="hora", type="string", length=10, nullable=true)
     */
    private $hora;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asiste_celula", type="boolean", nullable=true)
     */
    private $asisteCelula = 'true';

    /**
     * @var \Iglesia
     *
     * @ORM\ManyToOne(targetEntity="Iglesia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_iglesia", referencedColumnName="int_iglesia_id")
     * })
     */
    private $idIglesia;

    /**
     * @var \Lugar
     *
     * @ORM\ManyToOne(targetEntity="Lugar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lugar_id", referencedColumnName="int_lugar_id")
     * })
     */
    private $lugar;

    /**
     * @var \Red
     *
     * @ORM\ManyToOne(targetEntity="Red")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="red_id", referencedColumnName="int_red_id")
     * })
     */
    private $red;

    /**
     * @var \Ubicacion
     *
     * @ORM\ManyToOne(targetEntity="Ubicacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ubicacion", referencedColumnName="id")
     * })
     */
    private $idUbicacion;

    /**
     * @var \Archivo
     *
     * @ORM\ManyToOne(targetEntity="Archivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="foto", referencedColumnName="id")
     * })
     */
    private $foto;



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
     * Set nombre
     *
     * @param string $nombre
     * @return Persona
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
     * Set apellidos
     *
     * @param string $apellidos
     * @return Persona
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set estadoCivil
     *
     * @param integer $estadoCivil
     * @return Persona
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return integer 
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     * @return Persona
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer 
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Persona
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
     * Set celular
     *
     * @param string $celular
     * @return Persona
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Persona
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Persona
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set sexo
     *
     * @param integer $sexo
     * @return Persona
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return integer 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Persona
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     * @return Persona
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string 
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Persona
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
     * Set ganadoPor
     *
     * @param integer $ganadoPor
     * @return Persona
     */
    public function setGanadoPor($ganadoPor)
    {
        $this->ganadoPor = $ganadoPor;

        return $this;
    }

    /**
     * Get ganadoPor
     *
     * @return integer 
     */
    public function getGanadoPor()
    {
        return $this->ganadoPor;
    }

    /**
     * Set peticion
     *
     * @param string $peticion
     * @return Persona
     */
    public function setPeticion($peticion)
    {
        $this->peticion = $peticion;

        return $this;
    }

    /**
     * Get peticion
     *
     * @return string 
     */
    public function getPeticion()
    {
        return $this->peticion;
    }

    /**
     * Set dia
     *
     * @param string $dia
     * @return Persona
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
     * @return Persona
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
     * Set asisteCelula
     *
     * @param boolean $asisteCelula
     * @return Persona
     */
    public function setAsisteCelula($asisteCelula)
    {
        $this->asisteCelula = $asisteCelula;

        return $this;
    }

    /**
     * Get asisteCelula
     *
     * @return boolean 
     */
    public function getAsisteCelula()
    {
        return $this->asisteCelula;
    }

    /**
     * Set idIglesia
     *
     * @param \AE\DataBundle\Entity\Iglesia $idIglesia
     * @return Persona
     */
    public function setIdIglesia(\AE\DataBundle\Entity\Iglesia $idIglesia = null)
    {
        $this->idIglesia = $idIglesia;

        return $this;
    }

    /**
     * Get idIglesia
     *
     * @return \AE\DataBundle\Entity\Iglesia 
     */
    public function getIdIglesia()
    {
        return $this->idIglesia;
    }

    /**
     * Set lugar
     *
     * @param \AE\DataBundle\Entity\Lugar $lugar
     * @return Persona
     */
    public function setLugar(\AE\DataBundle\Entity\Lugar $lugar = null)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return \AE\DataBundle\Entity\Lugar 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set red
     *
     * @param \AE\DataBundle\Entity\Red $red
     * @return Persona
     */
    public function setRed(\AE\DataBundle\Entity\Red $red = null)
    {
        $this->red = $red;

        return $this;
    }

    /**
     * Get red
     *
     * @return \AE\DataBundle\Entity\Red 
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * Set idUbicacion
     *
     * @param \AE\DataBundle\Entity\Ubicacion $idUbicacion
     * @return Persona
     */
    public function setIdUbicacion(\AE\DataBundle\Entity\Ubicacion $idUbicacion = null)
    {
        $this->idUbicacion = $idUbicacion;

        return $this;
    }

    /**
     * Get idUbicacion
     *
     * @return \AE\DataBundle\Entity\Ubicacion 
     */
    public function getIdUbicacion()
    {
        return $this->idUbicacion;
    }

    /**
     * Set foto
     *
     * @param \AE\DataBundle\Entity\Archivo $foto
     * @return Persona
     */
    public function setFoto(\AE\DataBundle\Entity\Archivo $foto = null)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return \AE\DataBundle\Entity\Archivo 
     */
    public function getFoto()
    {
        return $this->foto;
    }
}

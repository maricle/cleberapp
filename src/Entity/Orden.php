<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Orden
 *
 *  
 *
 * @ORM\Table(name="orden", indexes={@ORM\Index(name="fk_orden_persona1_idx", columns={"persona_id"}), @ORM\Index(name="fk_orden_estadotrabajo1_idx", columns={"estadotrabajo_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\OrdenRepository")
 */
class Orden {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero", type="string", length=45, nullable=true)
     */
    private $numero;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var int|null
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=false)
     */
    private $prioridad = 3;

    /**
     * @var \Estadotrabajo
     *
     * @ORM\ManyToOne(targetEntity="Estadotrabajo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estadotrabajo_id", referencedColumnName="id")
     * })
     */
    private $estadotrabajo;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * })
     */
    private $persona;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrdenCaracteristica", mappedBy="orden", orphanRemoval=true)
     */
    private $caracteristicas;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="float")
     */
    private $cantidad = 1;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $medida_trabajo;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $papel;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $precio;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $copias;

    /**
     * @ORM\Column(type="boolean")
     */
    private $baja;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $numeracion;

    /**
     * @ORM\Column(type="float")
     */
    private $entrega;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $origial;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $impresion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $terminado;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $entregado;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sucursal;

    public function __construct() {
        $this->caracteristicas = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNumero(): ?string {
        return $this->numero;
    }

    public function setNumero(?string $numero): self {
        $this->numero = $numero;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self {
        $this->fecha = $fecha;

        return $this;
    }

    public function getPrioridad(): ?int {
        return $this->prioridad;
    }

    public function setPrioridad(?int $prioridad): self {
        $this->prioridad = $prioridad;

        return $this;
    }

    public function getEstadotrabajo(): ?Estadotrabajo {
        return $this->estadotrabajo;
    }

    public function setEstadotrabajo(?Estadotrabajo $estadotrabajo): self {
        $this->estadotrabajo = $estadotrabajo;

        return $this;
    }

    public function getPersona(): ?Persona {
        return $this->persona;
    }

    public function setPersona(?Persona $persona): self {
        $this->persona = $persona;

        return $this;
    }

    public function __toString() {
        return (string) $this->numero;
    }

    /**
     * @return Collection|OrdenCaracteristica[]
     */
    public function getCaracteristicas(): Collection {
        return $this->caracteristicas;
    }

    public function addCaracteristica(OrdenCaracteristica $caracteristica): self {
        if (!$this->caracteristicas->contains($caracteristica)) {
            $this->caracteristicas[] = $caracteristica;
            $caracteristica->setOrden($this);
        }

        return $this;
    }

    public function removeCaracteristica(OrdenCaracteristica $caracteristica): self {
        if ($this->caracteristicas->contains($caracteristica)) {
            $this->caracteristicas->removeElement($caracteristica);
            // set the owning side to null (unless already changed)
            if ($caracteristica->getOrden() === $this) {
                $caracteristica->setOrden(null);
            }
        }

        return $this;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCantidad(): ?float {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad): self {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getMedidaTrabajo(): ?string {
        return $this->medida_trabajo;
    }

    public function setMedidaTrabajo(string $medida_trabajo): self {
        $this->medida_trabajo = $medida_trabajo;

        return $this;
    }

    public function getPapel(): ?string {
        return $this->papel;
    }

    public function setPapel(?string $papel): self {
        $this->papel = $papel;

        return $this;
    }

    public function getColor(): ?string {
        return $this->color;
    }

    public function setColor(?string $color): self {
        $this->color = $color;

        return $this;
    }

    public function getPrecio(): ?float {
        return $this->precio;
    }

    public function setPrecio(?float $precio): self {
        $this->precio = $precio;

        return $this;
    }

    public function getCount() {

        return 40000;
    }
      public function getTerminadasCount() {

        return 386;
    }
    public function  getClientesMasImportantes(){
        return ['LaFormed', 'Sosa', 'Perez'];
    }

    public function getCopias(): ?int
    {
        return $this->copias;
    }

    public function setCopias(?int $copias): self
    {
        $this->copias = $copias;

        return $this;
    }

    public function getBaja(): ?bool
    {
        return $this->baja;
    }

    public function setBaja(bool $baja): self
    {
        $this->baja = $baja;

        return $this;
    }

    public function getNumeracion(): ?string
    {
        return $this->numeracion;
    }

    public function setNumeracion(?string $numeracion): self
    {
        $this->numeracion = $numeracion;

        return $this;
    }

    public function getEntrega(): ?float
    {
        return $this->entrega;
    }

    public function setEntrega(float $entrega): self
    {
        $this->entrega = $entrega;

        return $this;
    }

    public function getOrigial(): ?\DateTimeInterface
    {
        return $this->origial;
    }

    public function setOrigial(?\DateTimeInterface $origial): self
    {
        $this->origial = $origial;

        return $this;
    }

    public function getImpresion(): ?\DateTimeInterface
    {
        return $this->impresion;
    }

    public function setImpresion(?\DateTimeInterface $impresion): self
    {
        $this->impresion = $impresion;

        return $this;
    }

    public function getTerminado(): ?\DateTimeInterface
    {
        return $this->terminado;
    }

    public function setTerminado(?\DateTimeInterface $terminado): self
    {
        $this->terminado = $terminado;

        return $this;
    }

    public function getEntregado(): ?\DateTimeInterface
    {
        return $this->entregado;
    }

    public function setEntregado(?\DateTimeInterface $entregado): self
    {
        $this->entregado = $entregado;

        return $this;
    }

    public function getSucursal(): ?string
    {
        return $this->sucursal;
    }

    public function setSucursal(string $sucursal): self
    {
        $this->sucursal = $sucursal;

        return $this;
    }

}

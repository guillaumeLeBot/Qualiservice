<?php

namespace App\Entity;

use App\Repository\CalendarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendarRepository::class)]
class Calendar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end = null;

    #[ORM\Column(length: 255, nullable:true )]
    private ?string $description = null;

    #[ORM\Column(nullable:true)]
    private ?bool $all_day = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $background_color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $border_color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $text_color = null;

    #[ORM\Column(nullable: true)]
    private ?int $palletsNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $merchandise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToMany(targetEntity: Drivers::class, mappedBy: 'property_driver')]
    private Collection $drivers;

    #[ORM\ManyToMany(targetEntity: Building::class, mappedBy: 'property_building')]
    private Collection $buildings;

    #[ORM\ManyToMany(targetEntity: Supplier::class, mappedBy: 'property_supplier')]
    private Collection $suppliers;

    #[ORM\ManyToMany(targetEntity: Customer::class, mappedBy: 'property_customer')]
    private Collection $customers;

    #[ORM\ManyToMany(targetEntity: Mode::class, mappedBy: 'property_mode')]
    private Collection $modes;

    #[ORM\ManyToOne(inversedBy: 'driver')]
    private ?Drivers $driver = null;

    #[ORM\ManyToOne(inversedBy: 'building')]
    private ?Building $building = null;

    #[ORM\ManyToOne(inversedBy: 'supplier')]
    private ?Supplier $supplier = null;

    #[ORM\ManyToOne(inversedBy: 'customer')]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'mode')]
    private ?Mode $mode = null;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
        $this->buildings = new ArrayCollection();
        $this->suppliers = new ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->modes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isAllDay(): ?bool
    {
        return $this->all_day;
    }

    public function setAllDay(bool $all_day): self
    {
        $this->all_day = $all_day;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->background_color;
    }

    public function setBackgroundColor(?string $background_color): self
    {
        $this->background_color = $background_color;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->border_color;
    }

    public function setBorderColor(?string $border_color): self
    {
        $this->border_color = $border_color;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->text_color;
    }

    public function setTextColor(?string $text_color): self
    {
        $this->text_color = $text_color;

        return $this;
    }

    public function getPalletsNumber(): ?int
    {
        return $this->palletsNumber;
    }

    public function setPalletsNumber(?int $palletsNumber): self
    {
        $this->palletsNumber = $palletsNumber;

        return $this;
    }

    public function getMerchandise(): ?string
    {
        return $this->merchandise;
    }

    public function setMerchandise(?string $merchandise): self
    {
        $this->merchandise = $merchandise;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection<int, Drivers>
     */
    public function getDrivers(): Collection
    {
        return $this->drivers;
    }

    public function addDriver(Drivers $driver): self
    {
        if (!$this->drivers->contains($driver)) {
            $this->drivers->add($driver);
            $driver->addProperty($this);
        }

        return $this;
    }

    public function removeDriver(Drivers $driver): self
    {
        if ($this->drivers->removeElement($driver)) {
            $driver->removeProperty($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Building>
     */
    public function getBuildings(): Collection
    {
        return $this->buildings;
    }

    public function addBuilding(Building $building): self
    {
        if (!$this->buildings->contains($building)) {
            $this->buildings->add($building);
            $building->addProperty($this);
        }

        return $this;
    }

    public function removeBuilding(Building $building): self
    {
        if ($this->buildings->removeElement($building)) {
            $building->removeProperty($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Supplier>
     */
    public function getSuppliers(): Collection
    {
        return $this->suppliers;
    }

    public function addSupplier(Supplier $supplier): self
    {
        if (!$this->suppliers->contains($supplier)) {
            $this->suppliers->add($supplier);
            $supplier->addPropertySupplier($this);
        }

        return $this;
    }

    public function removeSupplier(Supplier $supplier): self
    {
        if ($this->suppliers->removeElement($supplier)) {
            $supplier->removePropertySupplier($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers->add($customer);
            $customer->addPropertyCustomer($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removePropertyCustomer($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Mode>
     */
    public function getModes(): Collection
    {
        return $this->modes;
    }

    public function addMode(Mode $mode): self
    {
        if (!$this->modes->contains($mode)) {
            $this->modes->add($mode);
            $mode->addPropertyMode($this);
        }

        return $this;
    }

    public function removeMode(Mode $mode): self
    {
        if ($this->modes->removeElement($mode)) {
            $mode->removePropertyMode($this);
        }

        return $this;
    }

    public function getDriver(): ?Drivers
    {
        return $this->driver;
    }

    public function setDriver(?Drivers $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): self
    {
        $this->building = $building;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getMode(): ?Mode
    {
        return $this->mode;
    }

    public function setMode(?Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }
}

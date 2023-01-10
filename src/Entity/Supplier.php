<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupplierRepository::class)]
class Supplier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Calendar::class, inversedBy: 'suppliers')]
    private Collection $property_supplier;

    #[ORM\OneToMany(mappedBy: 'supplier', targetEntity: Calendar::class)]
    private Collection $supplier;

    public function __construct()
    {
        $this->property_supplier = new ArrayCollection();
        $this->supplier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Calendar>
     */
    public function getPropertySupplier(): Collection
    {
        return $this->property_supplier;
    }

    public function addPropertySupplier(Calendar $propertySupplier): self
    {
        if (!$this->property_supplier->contains($propertySupplier)) {
            $this->property_supplier->add($propertySupplier);
        }

        return $this;
    }

    public function removePropertySupplier(Calendar $propertySupplier): self
    {
        $this->property_supplier->removeElement($propertySupplier);

        return $this;
    }

    /**
     * @return Collection<int, Calendar>
     */
    public function getSupplier(): Collection
    {
        return $this->supplier;
    }

    public function addSupplier(Calendar $supplier): self
    {
        if (!$this->supplier->contains($supplier)) {
            $this->supplier->add($supplier);
            $supplier->setSupplier($this);
        }

        return $this;
    }

    public function removeSupplier(Calendar $supplier): self
    {
        if ($this->supplier->removeElement($supplier)) {
            // set the owning side to null (unless already changed)
            if ($supplier->getSupplier() === $this) {
                $supplier->setSupplier(null);
            }
        }

        return $this;
    }
}

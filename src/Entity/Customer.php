<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Calendar::class, inversedBy: 'customers')]
    private Collection $property_customer;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Calendar::class)]
    private Collection $customer;

    public function __construct()
    {
        $this->property_customer = new ArrayCollection();
        $this->customer = new ArrayCollection();
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
    public function getPropertyCustomer(): Collection
    {
        return $this->property_customer;
    }

    public function addPropertyCustomer(Calendar $propertyCustomer): self
    {
        if (!$this->property_customer->contains($propertyCustomer)) {
            $this->property_customer->add($propertyCustomer);
        }

        return $this;
    }

    public function removePropertyCustomer(Calendar $propertyCustomer): self
    {
        $this->property_customer->removeElement($propertyCustomer);

        return $this;
    }

    /**
     * @return Collection<int, Calendar>
     */
    public function getCustomer(): Collection
    {
        return $this->customer;
    }

    public function addCustomer(Calendar $customer): self
    {
        if (!$this->customer->contains($customer)) {
            $this->customer->add($customer);
            $customer->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomer(Calendar $customer): self
    {
        if ($this->customer->removeElement($customer)) {
            // set the owning side to null (unless already changed)
            if ($customer->getCustomer() === $this) {
                $customer->setCustomer(null);
            }
        }

        return $this;
    }
}

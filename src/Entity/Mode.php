<?php

namespace App\Entity;

use App\Repository\ModeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeRepository::class)]
class Mode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Calendar::class, inversedBy: 'modes')]
    private Collection $property_mode;

    #[ORM\OneToMany(mappedBy: 'mode', targetEntity: Calendar::class)]
    private Collection $mode;

    public function __construct()
    {
        $this->property_mode = new ArrayCollection();
        $this->mode = new ArrayCollection();
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
    public function getPropertyMode(): Collection
    {
        return $this->property_mode;
    }

    public function addPropertyMode(Calendar $propertyMode): self
    {
        if (!$this->property_mode->contains($propertyMode)) {
            $this->property_mode->add($propertyMode);
        }

        return $this;
    }

    public function removePropertyMode(Calendar $propertyMode): self
    {
        $this->property_mode->removeElement($propertyMode);

        return $this;
    }

    /**
     * @return Collection<int, Calendar>
     */
    public function getMode(): Collection
    {
        return $this->mode;
    }

    public function addMode(Calendar $mode): self
    {
        if (!$this->mode->contains($mode)) {
            $this->mode->add($mode);
            $mode->setMode($this);
        }

        return $this;
    }

    public function removeMode(Calendar $mode): self
    {
        if ($this->mode->removeElement($mode)) {
            // set the owning side to null (unless already changed)
            if ($mode->getMode() === $this) {
                $mode->setMode(null);
            }
        }

        return $this;
    }
}

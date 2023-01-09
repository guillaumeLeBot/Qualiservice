<?php

namespace App\Entity;

use App\Repository\CalendarRepository;
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

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
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
    private ?string $building = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $supplier = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $driver = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $merchandise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

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

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(?string $building): self
    {
        $this->building = $building;

        return $this;
    }

    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    public function setSupplier(?string $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(?string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getDriver(): ?string
    {
        return $this->driver;
    }

    public function setDriver(?string $driver): self
    {
        $this->driver = $driver;

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
}

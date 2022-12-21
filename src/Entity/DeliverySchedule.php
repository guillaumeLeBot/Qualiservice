<?php

namespace App\Entity;

use App\Repository\DeliveryScheduleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryScheduleRepository::class)]
class DeliverySchedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dayCall = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hoursCall = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $arrivalTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $appointement = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $endingAppointement = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $departureTime = null;

    #[ORM\Column(length: 255)]
    private ?string $commandNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveredShipped = null;

    #[ORM\Column(length: 255)]
    private ?string $building = null;

    #[ORM\Column(length: 255)]
    private ?string $platform = null;

    #[ORM\Column(length: 255)]
    private ?string $supplier = null;

    #[ORM\Column(length: 255)]
    private ?string $customer = null;

    #[ORM\Column(length: 255)]
    private ?string $driver = null;

    #[ORM\Column]
    private ?int $palletsNumbers = null;

    #[ORM\Column(length: 255)]
    private ?string $merchandise = null;

    #[ORM\Column(length: 255)]
    private ?string $comment = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayCall(): ?\DateTimeInterface
    {
        return $this->dayCall;
    }

    public function setDayCall(\DateTimeInterface $dayCall): self
    {
        $this->dayCall = $dayCall;

        return $this;
    }

    public function getHoursCall(): ?\DateTimeInterface
    {
        return $this->hoursCall;
    }

    public function setHoursCall(\DateTimeInterface $hoursCall): self
    {
        $this->hoursCall = $hoursCall;

        return $this;
    }

    public function getArrivalTime(): ?\DateTimeInterface
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime(\DateTimeInterface $arrivalTime): self
    {
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    public function getAppointement(): ?\DateTimeInterface
    {
        return $this->appointement;
    }

    public function setAppointement(\DateTimeInterface $appointement): self
    {
        $this->appointement = $appointement;

        return $this;
    }

    public function getEndingAppointement(): ?\DateTimeInterface
    {
        return $this->endingAppointement;
    }

    public function setEndingAppointement(\DateTimeInterface $endingAppointement): self
    {
        $this->endingAppointement = $endingAppointement;

        return $this;
    }

    public function getDepartureTime(): ?\DateTimeInterface
    {
        return $this->departureTime;
    }

    public function setDepartureTime(\DateTimeInterface $departureTime): self
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    public function getCommandNumber(): ?string
    {
        return $this->commandNumber;
    }

    public function setCommandNumber(string $commandNumber): self
    {
        $this->commandNumber = $commandNumber;

        return $this;
    }

    public function getDeliveredShipped(): ?string
    {
        return $this->deliveredShipped;
    }

    public function setDeliveredShipped(string $deliveredShipped): self
    {
        $this->deliveredShipped = $deliveredShipped;

        return $this;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(string $building): self
    {
        $this->building = $building;

        return $this;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    public function setSupplier(string $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getDriver(): ?string
    {
        return $this->driver;
    }

    public function setDriver(string $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getPalletsNumbers(): ?int
    {
        return $this->palletsNumbers;
    }

    public function setPalletsNumbers(int $palletsNumbers): self
    {
        $this->palletsNumbers = $palletsNumbers;

        return $this;
    }

    public function getMerchandise(): ?string
    {
        return $this->merchandise;
    }

    public function setMerchandise(string $merchandise): self
    {
        $this->merchandise = $merchandise;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}

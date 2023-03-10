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
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    private ?Supplier $supplier = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    private ?Driver $driver = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    private ?Building $building = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commandNumber = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    private ?Platform $platform = null;

    #[ORM\Column(nullable: true)]
    private ?bool $speedSave = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $checked = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    private ?LogisticLeader $logisticLeader = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $checked_at = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $checked_by = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $validated = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $validated_at = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $validated_by = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $emailComeAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $emailDeparureAt = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    private ?DriverChecked $driverChecked = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    private ?LeaderChecked $leaderChecked = null;

    #[ORM\ManyToOne(inversedBy: 'calendars')]
    private ?Transporter $transporter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contentTruck = null;

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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

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

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(?Driver $driver): self
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

    public function getCommandNumber(): ?string
    {
        return $this->commandNumber;
    }

    public function setCommandNumber(string $commandNumber): self
    {
        $this->commandNumber = $commandNumber;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(?Platform $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getChecked(): ?string
    {
        return $this->checked;
    }

    public function setChecked(?string $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function isSpeedSave(): ?bool
    {
        return $this->speedSave;
    }

    public function setSpeedSave(?bool $speedSave): self
    {
        $this->speedSave = $speedSave;

        return $this;
    }

    public function getLogisticLeader(): ?LogisticLeader
    {
        return $this->logisticLeader;
    }

    public function setLogisticLeader(?LogisticLeader $logisticLeader): self
    {
        $this->logisticLeader = $logisticLeader;

        return $this;
    }

    public function getCheckedAt(): ?\DateTimeImmutable
    {
        return $this->checked_at;
    }

    public function setCheckedAt(?\DateTimeImmutable $checked_at): self
    {
        if ($checked_at !== null) {
            // Ajouter une heure ?? la date et l'heure en entr??e
            $checked_at = $checked_at->add(new \DateInterval('PT1H'));
        }

        $this->checked_at = $checked_at;

        return $this;
    }

    public function getCheckedBy(): ?string
    {
        return $this->checked_by;
    }

    public function setCheckedBy(?string $checked_by): self
    {
        $this->checked_by = $checked_by;

        return $this;
    }

    public function getValidated(): ?string
    {
        return $this->validated;
    }

    public function setValidated(?string $validated): self
    {
        $this->validated = $validated;

        return $this;
    }

    public function getValidatedAt(): ?\DateTimeImmutable
    {
        return $this->validated_at;
    }

    public function setValidatedAt(?\DateTimeImmutable $validated_at): self
    {
        $this->validated_at = $validated_at;

        return $this;
    }

    public function getValidatedBy(): ?string
    {
        return $this->validated_by;
    }

    public function setValidatedBy(?string $validated_by): self
    {
        $this->validated_by = $validated_by;

        return $this;
    }

    public function getEmailComeAt(): ?\DateTimeInterface
    {
        
        return $this->emailComeAt;
    }

    public function setEmailComeAt(?\DateTimeInterface $emailComeAt): self
    {
        if ($emailComeAt !== null) {
            // Convertir la date et l'heure en entr??e en objet DateTime
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $emailComeAt->format('Y-m-d H:i:s'));

            // Ajouter une heure ?? la date et l'heure en entr??e
            $dateTime->add(new \DateInterval('PT1H'));

            // D??finir la propri??t?? emailComeAt sur la nouvelle date et heure
            $emailComeAt = $dateTime;
        }

        $this->emailComeAt = $emailComeAt;

        return $this;
    }

    public function getEmailDeparureAt(): ?\DateTimeInterface
    {
        return $this->emailDeparureAt;
    }

    public function setEmailDeparureAt(
        ?\DateTimeInterface $emailDeparureAt
    ): self {
        $this->emailDeparureAt = $emailDeparureAt;

        return $this;
    }

    public function getDriverChecked(): ?DriverChecked
    {
        return $this->driverChecked;
    }

    public function setDriverChecked(?DriverChecked $driverChecked): self
    {
        $this->driverChecked = $driverChecked;

        return $this;
    }

    public function getLeaderChecked(): ?LeaderChecked
    {
        return $this->leaderChecked;
    }

    public function setLeaderChecked(?LeaderChecked $leaderChecked): self
    {
        $this->leaderChecked = $leaderChecked;

        return $this;
    }

    public function getTransporter(): ?Transporter
    {
        return $this->transporter;
    }

    public function setTransporter(?Transporter $transporter): self
    {
        $this->transporter = $transporter;

        return $this;
    }

    public function getContentTruck(): ?string
    {
        return $this->contentTruck;
    }

    public function setContentTruck(?string $contentTruck): self
    {
        $this->contentTruck = $contentTruck;

        return $this;
    }
}

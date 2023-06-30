<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HoursRepository::class)]
class Hours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Assert\Length(min: 5, max: 10)]
    #[Assert\NotBlank()]
    private ?string $dayWeek = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\Time]
    private ?\DateTimeInterface $morning_open_hours = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\Time]
    private ?\DateTimeInterface $morning_close_hours = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\Time]
    private ?\DateTimeInterface $afternoon_open_hours = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\Time]
    private ?\DateTimeInterface $afternoon_close_hours = null;

    #[ORM\Column]
    private ?bool $is_open = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayWeek(): ?string
    {
        return $this->dayWeek;
    }

    public function setDayWeek(string $dayWeek): static
    {
        $this->dayWeek = $dayWeek;

        return $this;
    }

    public function getMorningOpenHours(): ?\DateTimeInterface
    {
        return $this->morning_open_hours;
    }

    public function setMorningOpenHours(\DateTimeInterface $morning_open_hours): static
    {
        $this->morning_open_hours = $morning_open_hours;

        return $this;
    }

    public function getMorningCloseHours(): ?\DateTimeInterface
    {
        return $this->morning_close_hours;
    }

    public function setMorningCloseHours(\DateTimeInterface $morning_close_hours): static
    {
        $this->morning_close_hours = $morning_close_hours;

        return $this;
    }

    public function getAfternoonOpenHours(): ?\DateTimeInterface
    {
        return $this->afternoon_open_hours;
    }

    public function setAfternoonOpenHours(\DateTimeInterface $afternoon_open_hours): static
    {
        $this->afternoon_open_hours = $afternoon_open_hours;

        return $this;
    }

    public function getAfternoonCloseHours(): ?\DateTimeInterface
    {
        return $this->afternoon_close_hours;
    }

    public function setAfternoonCloseHours(\DateTimeInterface $afternoon_close_hours): static
    {
        $this->afternoon_close_hours = $afternoon_close_hours;

        return $this;
    }

    public function isIsOpen(): ?bool
    {
        return $this->is_open;
    }

    public function setIsOpen(bool $is_open): static
    {
        $this->is_open = $is_open;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HoursRepository::class)]
class Hours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(min: 2, max: 20)]
    #[Assert\NotBlank()]
    private ?string $dayWeek = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 20)]
    private ?string $morning_open_hours = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 20)]
    private ?string $morning_close_hours = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 20)]
    private ?string $afternoon_open_hours = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 5, max: 20)]
    private ?string $afternoon_close_hours = null;

    // #[ORM\Column]
    // private ?bool $is_open = null;

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

    public function getMorningOpenHours(): ?string
    {
        return $this->morning_open_hours;
    }

    public function setMorningOpenHours(?string $morning_open_hours): self
    {
        $this->morning_open_hours = $morning_open_hours;

        return $this;
    }

    public function getMorningCloseHours(): ?string
    {
        return $this->morning_close_hours;
    }

    public function setMorningCloseHours(?string $morning_close_hours): self
    {
        $this->morning_close_hours = $morning_close_hours;

        return $this;
    }

    public function getAfternoonOpenHours(): ?string
    {
        return $this->afternoon_open_hours;
    }

    public function setAfternoonOpenHours(?string $afternoon_open_hours): self
    {
        $this->afternoon_open_hours = $afternoon_open_hours;

        return $this;
    }

    public function getAfternoonCloseHours(): ?string
    {
        return $this->afternoon_close_hours;
    }

    public function setAfternoonCloseHours(?string $afternoon_close_hours): self
    {
        $this->afternoon_close_hours = $afternoon_close_hours;

        return $this;
    }

    // public function isIsOpen(): ?bool
    // {
    //     return $this->is_open;
    // }

    // public function setIsOpen(bool $is_open): static
    // {
    //     $this->is_open = $is_open;

    //     return $this;
    // }
}

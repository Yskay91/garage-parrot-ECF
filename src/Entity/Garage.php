<?php

namespace App\Entity;

use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GarageRepository::class)]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(min: 2, max: 100)]
    #[Assert\NotBlank()]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 5, max: 255)]
    #[Assert\NotBlank()]
    private ?string $adresse = null;

    #[ORM\Column(length: 10)]
    #[Assert\Length(min: 3, max: 10)]
    #[Assert\NotBlank()]
    private ?string $zipCode = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 1, max: 255)]
    #[Assert\NotBlank()]
    private ?string $city = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(min: 10, max: 100)]
    private ?string $phone = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(min: 10, max: 100)]
    #[Assert\Email]
    private ?string $mail = null;

    private ?float $average = null;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Reviews::class, orphanRemoval: true)]
    private Collection $note;

    public function __construct()
    {
        $this->note = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAverage(): ?float
    {
        $review = $this->review;
        return $this->average;
    }

    /**
     * @return Collection<int, Reviews>
     */
    public function getNote(): Collection
    {
        return $this->note;
    }

    public function addNote(Reviews $note): static
    {
        if (!$this->note->contains($note)) {
            $this->note->add($note);
            $note->setGarage($this);
        }

        return $this;
    }

    public function removeNote(Reviews $note): static
    {
        if ($this->note->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getGarage() === $this) {
                $note->setGarage(null);
            }
        }

        return $this;
    }
}

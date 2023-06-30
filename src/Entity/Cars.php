<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarsRepository::class)]
class Cars
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(min: 2, max: 100)]
    #[Assert\NotBlank()]
    private ?string $brand = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(min: 2, max: 100)]
    #[Assert\NotBlank()]
    private ?string $model = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Positive()]
    private ?float $price = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Positive()]
    private ?int $kilometre = null;

    #[ORM\Column]
    #[Assert\Positive()]
    #[Assert\Length(exactly: 4)]
    #[Assert\NotBlank]
    #[Assert\LessThanOrEqual('date(Y)')]
    private ?int $year = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 4, max: 10)]
    private ?string $reference = null;

    #[ORM\Column]
    #[Assert\DateTime]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Images::class)]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Features::class, orphanRemoval: true)]
    private Collection $features;


    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->features = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getKilometre(): ?int
    {
        return $this->kilometre;
    }

    public function setKilometre(int $kilometre): static
    {
        $this->kilometre = $kilometre;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setCar($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCar() === $this) {
                $image->setCar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Features>
     */
    public function getFeatures(): Collection
    {
        return $this->features;
    }

    public function addFeature(Features $feature): static
    {
        if (!$this->features->contains($feature)) {
            $this->features->add($feature);
            $feature->setCar($this);
        }

        return $this;
    }

    public function removeFeature(Features $feature): static
    {
        if ($this->features->removeElement($feature)) {
            // set the owning side to null (unless already changed)
            if ($feature->getCar() === $this) {
                $feature->setCar(null);
            }
        }

        return $this;
    }
}

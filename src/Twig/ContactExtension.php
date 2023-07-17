<?php
namespace App\Twig;

use App\Entity\Garage;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class ContactExtension extends AbstractExtension
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('garage', [$this, 'getGarages'])
        ];
    }

    public function getGarages()
    {
        return $this->manager->getRepository(Garage::class)->findAll();
    }
}
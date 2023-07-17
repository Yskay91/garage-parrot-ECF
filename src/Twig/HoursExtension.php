<?php
namespace App\Twig;

use App\Entity\Hours;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class HoursExtension extends AbstractExtension
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('hour', [$this, 'getHours'])
        ];
    }

    public function getHours()
    {
        return $this->manager->getRepository(Hours::class)->findAll();
    }
}
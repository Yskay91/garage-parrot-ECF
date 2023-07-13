<?php

namespace App\Controller;

use App\Entity\Garage;
use App\Form\GarageType;
use App\Repository\GarageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class GarageController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/garage', name: 'garage.index')]
    public function index(GarageRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $garages = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit par page*/
        );
        return $this->render('pages/garage/index.html.twig', [
            'garages' => $garages
        ]);
    }
}

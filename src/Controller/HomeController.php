<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Form\ReviewsType;
use App\Repository\GarageRepository;
use App\Repository\ReviewsRepository;
use App\Repository\ServicesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    // #[Route('/', name: 'home.index', methods: ['GET'])] //ajout des méthodes pour sécurisé le site
    // public function index(): Response
    // {
    //     return $this->render('pages/home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }

    /**
     * Undocumented function
     *
     * @param ServicesRepository $repository
     * @param GarageRepository $repositoryGge
     * @param ReviewsRepository $repositoryReviews
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function listeServices(ServicesRepository $repository, GarageRepository $repositoryGge, ReviewsRepository $repositoryReviews, PaginatorInterface $paginator, Request $request): Response
    {
        $services = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit par page*/
        );

        $reviews = $repositoryReviews->findAll();

        return $this->render('pages/home/index.html.twig', [
            'services' => $services,
            'reviews' => $reviews
        ]);
    }
}

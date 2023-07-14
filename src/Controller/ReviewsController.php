<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Form\ReviewsType;
use App\Repository\ReviewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ReviewsController extends AbstractController
{
    /**
     * Cette fonction affiche les reviews
     *
     * @param ReviewsRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/avis', name: 'reviews.index')]
    public function index(ReviewsRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $reviews = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit par page*/
        );

        return $this->render('pages/reviews/index.html.twig', [
            'reviews' => $reviews
        ]);
    }

    /**
     * Création du formulaire d'ajout d'un avis
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/avis/ajouter', name: 'reviews.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $reviews = new Reviews;

        $form = $this->createForm(ReviewsType::class, $reviews);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reviews = $form->getData();

            $manager->persist($reviews); //identique à un commit
            $manager->flush(); //identique à un push

            $this->addFlash(
                'success',
                'L\'avis a bien été ajouté'
            );

            return $this->redirectToRoute('home.index');
        }

        return $this->render(
            'pages/reviews/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Permet de modifier un avis
     *
     * @param Reviews $reviews
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/avis/modifier/{id}', 'reviews.edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_EMPLOYE')]
    public function edit(
        Reviews $reviews,
        Request $request,
        EntityManagerInterface $manager
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        $form = $this->createForm(ReviewsType::class, $reviews);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reviews = $form->getData();

            $manager->persist($reviews); //identique à un commit
            $manager->flush(); //identique à un push

            $this->addFlash(
                'success',
                'L\'avis a bien été modifié'
            );

            return $this->redirectToRoute('reviews.index');
        }

        return $this->render('pages/reviews/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Cette fonction permet de supprimer un avis
     *
     * @param EntityManagerInterface $manager
     * @param Reviews $reviews
     * @return Response
     */
    #[Route('/avis/supprimer/{id}', name: 'reviews.delete', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(
        EntityManagerInterface $manager,
        Reviews $reviews
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }
        
        $manager->remove($reviews);
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'avis a bien été supprimé'
        );

        return $this->redirectToRoute('reviews.index');
    }
}

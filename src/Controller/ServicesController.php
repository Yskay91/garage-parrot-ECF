<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
    /**
     * Cette fonction affiche les services
     *
     * @param ServicesRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/services', name: 'services.index')]
    public function index(ServicesRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $services = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit par page*/
        );

        return $this->render('pages/services/index.html.twig', [
            'services' => $services
        ]);
    }

    /**
     * Création du formulaire d'ajout d'un service
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/services/ajouter', name: 'services.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $service = new Services;

        $form = $this->createForm(ServicesType::class, $service);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();

            $manager->persist($service); //identique à un commit
            $manager->flush(); //identique à un push

            $this->addFlash(
                'success',
                'Le service a bien été ajouté'
            );

            return $this->redirectToRoute('services.index');
        }

        return $this->render(
            'pages/services/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Permet de modifier un service
     *
     * @param Services $services
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/services/modifier/{id}', 'services.edit', methods: ['GET', 'POST'])]
    public function edit(
        Services $services,
        Request $request,
        EntityManagerInterface $manager
    ): Response {

        $form = $this->createForm(ServicesType::class, $services);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $services = $form->getData();

            $manager->persist($services); //identique à un commit
            $manager->flush(); //identique à un push

            $this->addFlash(
                'success',
                'Le service a bien été modifié'
            );

            return $this->redirectToRoute('services.index');
        }

        return $this->render('pages/services/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Cette fonction permet de supprimer un service
     *
     * @param EntityManagerInterface $manager
     * @param Services $services
     * @return Response
     */
    #[Route('/services/supprimer/{id}', name: 'services.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Services $services
    ): Response {
        $manager->remove($services);
        $manager->flush();

        $this->addFlash(
            'success',
            'Le service a bien été supprimé'
        );

        return $this->redirectToRoute('services.index');
    }
}

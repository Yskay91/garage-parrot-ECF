<?php

namespace App\Controller;

use App\Entity\Images;
use App\Form\ImagesType;
use App\Repository\ImagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ImagesController extends AbstractController
{
    /**
     * Cette fonction affiche les images
     *
     * @param ImagesRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/images', name: 'images.index')]
    #[IsGranted('ROLE_EMPLOYE')]
    public function index(ImagesRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        $images = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit par page*/
        );

        return $this->render('pages/images/index.html.twig', [
            'images' => $images
        ]);
    }

    /**
     * Création du formulaire d'ajout d'une image
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/images/ajouter', name: 'images.new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_EMPLOYE')]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        $image = new Images;

        $form = $this->createForm(ImagesType::class, $image);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->getData();

            $manager->persist($image); //identique à un commit
            $manager->flush(); //identique à un push

            $this->addFlash(
                'success',
                'L\'image a bien été ajoutée'
            );

            return $this->redirectToRoute('images.index');
        }

        return $this->render(
            'pages/images/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Permet de modifier une image
     *
     * @param Images $images
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/images/modifier/{id}', 'images.edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_EMPLOYE')]
    public function edit(
        Images $images,
        Request $request,
        EntityManagerInterface $manager
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        $form = $this->createForm(ImagesType::class, $images);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->getData();

            $manager->persist($images); //identique à un commit
            $manager->flush(); //identique à un push

            $this->addFlash(
                'success',
                'L\'image a bien été modifiée'
            );

            return $this->redirectToRoute('images.index');
        }

        return $this->render('pages/images/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Cette fonction permet de supprimer une image
     *
     * @param EntityManagerInterface $manager
     * @param Images $images
     * @return Response
     */
    #[Route('/images/supprimer/{id}', name: 'images.delete', methods: ['GET'])]
    #[IsGranted('ROLE_EMPLOYE')]
    public function delete(
        EntityManagerInterface $manager,
        Images $images
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }
        
        $manager->remove($images);
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'image a bien été supprimée'
        );

        return $this->redirectToRoute('images.index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Hours;
use App\Form\HoursType;
use App\Repository\HoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HoursController extends AbstractController
{
    #[Route('/horaire', name: 'hours.index', methods: ['GET'])]
    public function index(HoursRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $hours = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit par page*/
        );
        
        return $this->render('pages/hours/index.html.twig', [
            'hours' => $hours
        ]);
    }
    
    /**
     * Création du formulaire d'ajout
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/horaire/ajouter', name: 'hours.new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }
        
        $hour = new Hours;
        
        $form = $this->createForm(HoursType::class, $hour);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hour = $form->getData();

            $manager->persist($hour); //identique à un commit
            $manager->flush(); //identique à un push

            $this->addFlash(
                'success',
                'L\'horaire a bien été ajouté'
            );

            return $this->redirectToRoute('hours.index');
        }

        return $this->render(
            'pages/hours/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    #[Route('/horaire/modifier/{id}', 'hours.edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(
        Hours $hour,
        Request $request,
        EntityManagerInterface $manager
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }
        

        $form = $this->createForm(HoursType::class, $hour);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hour = $form->getData();

            $manager->persist($hour); //identique à un commit
            $manager->flush(); //identique à un push

            $this->addFlash(
                'success',
                'L\'horaire a bien été modifié'
            );

            return $this->redirectToRoute('hours.index');
        }

        return $this->render('pages/hours/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/horaire/supprimer/{id}', 'hours.delete', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(
        EntityManagerInterface $manager,
        Hours $hour
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }
        
        $manager->remove($hour);
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'horaire a bien été supprimé'
        );

        return $this->redirectToRoute('hours.index');
    }
}

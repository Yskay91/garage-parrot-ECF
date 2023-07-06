<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    /**
     * Cette fonction affiche les services
     *
     * @param MessagesRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/messages', name: 'messages.index')]
    public function index(MessagesRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $messages = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit par page*/
        );

        return $this->render('pages/messages/index.html.twig', [
            'messages' => $messages
        ]);
    }

    /**
     * Création du formulaire d'ajout d'un message
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/contact', name: 'messages.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $messages = new Messages;

        $form = $this->createForm(MessagesType::class, $messages);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messages = $form->getData();

            $manager->persist($messages); //identique à un commit
            $manager->flush(); //identique à un push

            $this->addFlash(
                'success',
                'Le message a bien été envoyé. Vous recevrez une réponse dans les plus brefs délais.'
            );

            return $this->redirectToRoute('messages.new');
        }

        return $this->render(
            'pages/messages/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Cette fonction permet de supprimer un service
     *
     * @param EntityManagerInterface $manager
     * @param Services $services
     * @return Response
     */
    #[Route('/messages/supprimer/{id}', name: 'messages.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Messages $messages
    ): Response {
        $manager->remove($messages);
        $manager->flush();

        $this->addFlash(
            'success',
            'Le message a bien été supprimé'
        );

        return $this->redirectToRoute('messages.index');
    }
}


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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
    #[IsGranted('ROLE_ADMIN')]
    public function index(
        MessagesRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

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
        EntityManagerInterface $manager,
        MailerInterface $mailer
    ): Response {
        $messages = new Messages();

        $form = $this->createForm(MessagesType::class, $messages);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messages = $form->getData();

            $manager->persist($messages); //identique à un commit
            $manager->flush(); //identique à un push

            $email = (new Email())
            ->from($messages->getEmail())
            ->to('you@example.com')
            ->subject($messages->getSubject())
            ->html($messages->getMessage());

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Le message a bien été envoyé. Vous recevrez une réponse dans les plus brefs délais.'
            );

            return $this->redirectToRoute('messages.new');
        }

        return $this->render(
            'pages/messages/new.html.twig',
            [
                'form' => $form->createView(),
                'messages' => $messages,
            ]
        );
    }

    #[Route('/annonces', name: 'messages.modal', methods: ['POST'])]
    public function modal(
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer
    ): Response {
        $messageAnnonce = new Messages();

        $form = $this->createForm(MessagesType::class, $messageAnnonce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messages = $form->getData();

            $manager->persist($messages);
            $manager->flush();

            $email = (new Email())
                ->from($messages->getEmail())
                ->to('v.parrot@garage-parrot.fr')
                ->subject($messages->getSubject())
                ->html($messages->getMessage());

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Le message a bien été envoyé. Vous recevrez une réponse dans les plus brefs délais.'
            );

            return $this->redirectToRoute('car.index');
        }

        return $this->render(
            'pages/cars/index.html.twig',
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
    #[IsGranted('ROLE_ADMIN')]
    public function delete(
        EntityManagerInterface $manager,
        Messages $messages
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        $manager->remove($messages);
        $manager->flush();

        $this->addFlash(
            'success',
            'Le message a bien été supprimé'
        );

        return $this->redirectToRoute('messages.index');
    }
}

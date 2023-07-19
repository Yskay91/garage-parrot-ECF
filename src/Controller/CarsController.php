<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\CarsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarsController extends AbstractController
{
    /**
     * Retourne la liste des annonces
     *
     * @param CarsRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/annonces', name: 'car.index')]
    public function index(
        CarsRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {

        $cars = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/cars/index.html.twig', [
            'cars' => $cars
        ]);
    }

    #[Route('/annonce/{id}', name: 'car.details')]
    public function carMessage(
        int $id,
        CarsRepository $repository,
        EntityManagerInterface $manager,
        Request $request
    ): Response {
        $messages = new Messages();

        $carWithId = $repository->find($id);
        $emailSubject = $carWithId->getFullname();

        $form = $this->createForm(MessagesType::class, $messages);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messages = $form->getData();

            $manager->persist($messages);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre message a été envoyé.'
            );
        }

        return $this->render('pages/cars/car.html.twig', [
            'car' => $carWithId,
            'contact_form' => $form->createView(),
        ]);
    }

}

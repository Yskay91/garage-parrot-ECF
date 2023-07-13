<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\CarsType;
use App\Entity\Messages;
use App\Form\MessagesType;
use App\Repository\MessagesRepository;
use App\Repository\CarsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
        Request $request,
        MailerInterface $mailer
    ): Response {
        $cars = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit par page*/
        );

        return $this->render('pages/cars/index.html.twig', [
            'cars' => $cars
        ]);
    }

    /**
     * Ajoute une annonce
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[IsGranted('ROLE_EMPLOYE')]
    #[Route('/annonces/ajouter', name: 'car.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $car = new Cars(); //création d'une nouvelle car

        $form = $this->createForm(CarsType::class, $car);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $manager->persist($car); //comme un commit sur git
            $manager->flush(); //Ajout en bdd - comme un push

            $this->addFlash(
                'success',
                'La voiture a bien été ajoutée'
            );

            return $this->redirectToRoute('car.index');
        } else {
            $this->addFlash(
                'warning',
                'il y a une erreur dans le formulaire'
            );
        }

        return $this->render('pages/cars/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Modifie une annonce
     */
    #[IsGranted('ROLE_EMPLOYE')]
    #[Route('annonces/modifier/{id}', 'car.edit', methods: ['GET', 'POST'])]
    public function edit(
        Cars $car,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $manager->persist($car); //comme un commit sur git
            $manager->flush(); //Ajout en bdd - comme un push

            $this->addFlash(
                'success',
                'L\'annonce a bien été modifiée'
            );

            return $this->redirectToRoute('car.index');
        } else {
            $this->addFlash(
                'warning',
                'il y a une erreur dans le formulaire'
            );
        }

        return $this->render('pages/cars/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Supprime une annonce
     *
     * @param EntityManagerInterface $manager
     * @param Car $car
     * @return Response
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('annonces/supprimer/{id}', 'car.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Cars $car
    ): Response {
        $manager->remove($car);
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'annonce a bien été supprimée'
        );

        return $this->redirectToRoute('car.index');
    }
}

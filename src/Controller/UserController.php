<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UsersType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * Affiche la liste des employés
     *
     * @param UserRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/liste-employes', name: 'user.index', methods: ['GET'])]
    public function showListeEmploye(UserRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $users = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit par page*/
        );

        return $this->render('pages/user/index.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * Ce controller modifie un employé
     */
    #[Route('/employe/modifier/{id}', 'user.edit', methods: ['GET', 'POST'])]
    public function edit(
        User $user,
        Request $request,
        EntityManagerInterface $manager
    ): Response {


        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        if ($this->getUser() === $user) {
            return $this->redirectToRoute('home.index');
        }

        $form = $this->createForm(UsersType::class, $user);

        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {

        //     $user = $form->getData();

        //     $manager->persist($user); //comme un commit sur git
        //     $manager->flush(); //Ajout en bdd - comme un push

        //     $this->addFlash(
        //         'success',
        //         'L\'utilisateur a bien été modifié'
        //     );

        //     return $this->redirectToRoute('security.index');
        // } else {
        //     $this->addFlash(
        //         'warning',
        //         'il y a une erreur dans le formulaire'
        //     );
        // }

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/employe/supprimer/{id}', 'user.delete', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        User $user
    ): Response {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'utilisateur a bien été supprimé'
        );

        return $this->redirectToRoute('user.index');
    }
}

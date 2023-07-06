<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditPasswordType;
use App\Form\UsersType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
     * Ce controller permet de modifier un employé
     *
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $hasher
     * @return Response
     */
    #[Route('/employe/modifier/{id}', name: 'user.edit', methods: ['GET', 'POST'])]
    public function edit(
        User $user,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        $form = $this->createForm(UsersType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())) {
                $user = $form->getData();

                $manager->persist($user); //comme un commit sur git
                $manager->flush(); //Ajout en bdd - comme un push

                $this->addFlash(
                    'success',
                    'L\'utilisateur a bien été modifié'
                );

                return $this->redirectToRoute('car.index');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe n\'est pas correct'
                );
            }
        }

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/employe/supprimer/{id}', name: 'user.delete', methods: ['GET'])]
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

    /**
     * Ce controller permet de modifier le mot de passe
     *
     * @param User $user
     * @param Request $request
     * @return Response
     */
    #[Route('/employe/modifier-mot-de-passe/{id}', name: 'user.edit.password', methods: ['GET', 'POST'])]
    public function editPassword(
        User $user,
        Request $request,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $manager
    ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        $form = $this->createForm(EditPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->getData()['plainPassword'])) {
                $user->setPassword(
                    $hasher->hashPassword(
                        $user,
                        $form->getData()['newPassword']
                    )
                );

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Le mot de passe a bien été modifié'
                );

                return $this->redirectToRoute('car.index');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe n\'est pas correct'
                );
            }
        }

        return $this->render('pages/user/edit_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

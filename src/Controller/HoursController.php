<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HoursController extends AbstractController
{
    #[Route('/hours', name: 'app_hours')]
    public function index(): Response
    {
        return $this->render('hours/index.html.twig', [
            'controller_name' => 'HoursController',
        ]);
    }
}

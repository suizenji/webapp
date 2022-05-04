<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnrollController extends AbstractController
{
    #[Route('/enroll', name: 'app_enroll')]
    public function index(): Response
    {
        return $this->render('enroll/index.html.twig', [
            'controller_name' => 'EnrollController',
        ]);
    }
}

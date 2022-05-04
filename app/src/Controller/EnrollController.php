<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/enroll', name: 'enroll_')]
class EnrollController extends AbstractController
{
    #[Route('/input', name: 'input', methods: ['GET'])]
    public function input(): Response
    {
        return $this->render('enroll/input.html.twig', [
            'controller_name' => 'EnrollController',
        ]);
    }
}

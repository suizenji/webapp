<?php

namespace App\Controller;

use App\Form\EnrollType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/enroll', name: 'enroll_')]
class EnrollController extends AbstractController
{
    #[Route('/input', name: 'input', methods: ['GET'])]
    public function input(): Response
    {
        $form = $this->createForm(EnrollType::class);

        return $this->render('enroll/input.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

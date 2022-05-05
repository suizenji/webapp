<?php

namespace App\Controller;

use App\Entity\MEMBER;
use App\Form\EnrollType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/enroll', name: 'enroll_', methods: ['HEAD', 'GET'])]
class EnrollController extends AbstractController
{
    #[Route('/input', name: 'input', methods: ['POST'])]
    public function input(Request $request): Response
    {
        $member = new MEMBER();
        $form = $this->createForm(EnrollType::class, $member);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            var_dump('submit!');
        }

        return $this->render('enroll/input.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

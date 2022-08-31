<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WireframeController extends AbstractController
{
    #[Route('/wireframe', name: 'app_wireframe')]
    public function index(): Response
    {
        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'index',
        ]);
    }

    #[Route('/wireframe/input', name: 'app_wireframe_input')]
    public function input(): Response
    {
        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'input',
        ]);
    }

    #[Route('/wireframe/confirm', name: 'app_wireframe_confirm')]
    public function confirm(): Response
    {
        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'confirm',
        ]);
    }

    #[Route('/wireframe/result', name: 'app_wireframe_result')]
    public function result(): Response
    {
        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'result',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArgResolvController extends AbstractController
{
    #[Route('/arg/resolv', name: 'app_arg_resolv')]
    public function index(): Response
    {
        return $this->render('arg_resolv/index.html.twig', [
            'controller_name' => 'ArgResolvController',
        ]);
    }
}

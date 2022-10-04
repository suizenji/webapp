<?php

namespace App\Controller;

use App\Exception\AppException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThrowController extends AbstractController
{
    #[Route('/throw', name: 'app_throw')]
    public function index(): Response
    {
        throw new AppException('throw!!');
    }
}

<?php

namespace App\Controller;

use App\Traits\AccessorAttr;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SandboxController extends AbstractController
{
    #[Route('/sandbox', name: 'app_sandbox')]
    public function index(): Response
    {
        $foo = new class() {
            use AccessorAttr;
        };
        $foo->set('bar', 'val');
        var_dump($foo->get('bar'));

        return $this->render('sandbox/index.html.twig', [
            'controller_name' => 'SandboxController',
        ]);
    }
}

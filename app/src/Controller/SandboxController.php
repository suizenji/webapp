<?php

namespace App\Controller;

use App\Sandbox\AcsAtr;
use App\Traits\AccessorAttr;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SandboxController extends AbstractController
{
    #[Route('/sandbox', name: 'app_sandbox')]
    public function index(): Response
    {
        $obj = new AcsAtr();
        var_dump($obj->get('priInt'));
        $obj->set('priInt', 1);
        var_dump($obj->get('priInt'));

        return $this->render('sandbox/index.html.twig', [
            'controller_name' => 'SandboxController',
        ]);
    }
}

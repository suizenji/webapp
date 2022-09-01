<?php

namespace App\Controller;

use App\Workflow\Entity\WireframeEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Workflow;

class WireframeController extends AbstractController
{
    public function __construct(private Registry $workflows)
    {
    }

    #[Route('/wireframe', name: 'app_wireframe')]
    public function index(WireframeEntity $wireframe): Response
    {
        $stateMachine = $this->workflows->get($wireframe);

        var_dump($stateMachine->can($wireframe, 'visit'));

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

<?php

namespace App\Controller;

use App\ArgumentResolver\AppArgumentResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArgResolvController extends AbstractController
{
    #[Route('/arg/resolv', name: 'app_arg_resolv')]
    public function index(
        \StdClass $stdClass,
        AppArgumentResolver $resolver,
    ): Response {
        $controller = [$this, 'di'];
        $args = $resolver->getArguments($controller);
        $controller(...$args);
        

        return $this->render('arg_resolv/index.html.twig', [
            'controller_name' => 'ArgResolvController',
        ]);
    }

    public function di(
        EntityManagerInterface $manager
    ) {
        var_dump('resolved!');
    }
}

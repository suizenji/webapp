<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HttpController extends AbstractController
{
    #[Route('/http', name: 'app_http')]
    public function index(HttpClientInterface $client): Response
    {
        $response = $client->request('GET', 'https://www.ugtop.com/spill.shtml');

        return new Response($response->getContent());
    }
}

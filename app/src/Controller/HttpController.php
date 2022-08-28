<?php

namespace App\Controller;

use App\Service\Acme\AcmeServiceInterface;
use App\Service\Acme\AcmeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HttpController extends AbstractController
{
    #[Route('/http', name: 'app_http')]
    public function index(
        HttpClientInterface $ugtopClient,
        AcmeService $acme,
    ): Response {
#        $response = $ugtopClient->request('GET', 'https://www.ugtop.com/spill.shtml');
        $response = $ugtopClient->request('GET', '/spill.shtml');

        $acme->proc();

        return new Response($response->getContent());
    }
}

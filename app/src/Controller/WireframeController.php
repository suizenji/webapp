<?php

namespace App\Controller;

use App\Workflow\Wireframe\Wireframe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WireframeController extends AbstractController
{
    public function __construct(private Wireframe $wf)
    {
    }

    #[Route('/wireframe', name: 'app_wireframe')]
    public function index(): Response
    {
        $this->wf->reset('my_wireframe');
        $this->dump();

        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'index',
        ]);
    }

    #[Route('/wireframe/input', name: 'app_wireframe_input')]
    public function input(): Response
    {
        $this->dump();

        if ($this->wf->isValid('my_wireframe', 'visit')) {
            echo 'first access';
            $this->wf->update('my_wireframe', 'visit');
        } else if ($this->wf->isValid('my_wireframe', 'rewrite')) {
            echo 'rewrite';
            $this->wf->update('my_wireframe', 'rewrite');
        } else {
            echo 'NG';
        }

        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'input',
        ]);
    }

    #[Route('/wireframe/confirm', name: 'app_wireframe_confirm')]
    public function confirm(): Response
    {
        $this->dump();

        if ($this->wf->isValid('my_wireframe', 'write_out')) {
            echo 'write_out';
            $this->wf->update('my_wireframe', 'write_out');
        } else {
            echo 'NG';
        }

        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'confirm',
        ]);
    }

    #[Route('/wireframe/result', name: 'app_wireframe_result')]
    public function result(): Response
    {
        $this->dump();

        if ($this->wf->isValid('my_wireframe', 'submit')) {
            echo 'submit';
            $this->wf->update('my_wireframe', 'submit');
        } else {
            echo 'NG';
        }

        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'result',
        ]);
    }

    public function dump()
    {
        $entity = $this->wf->getEntity('my_wireframe');
        echo 'place:';
        var_dump($entity->getCurrentPlace());

        echo 'visit:';
        var_dump($this->wf->isValid('my_wireframe', 'visit'));

        echo 'write_out:';
        var_dump($this->wf->isValid('my_wireframe', 'write_out'));

        echo 'submit:';
        var_dump($this->wf->isValid('my_wireframe', 'submit'));

        echo 'rewrite';
        var_dump($this->wf->isValid('my_wireframe', 'rewrite'));
    }
}

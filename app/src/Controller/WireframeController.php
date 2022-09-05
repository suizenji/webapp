<?php

namespace App\Controller;

use App\Workflow\Wireframe\WireframeInterface;
use App\Workflow\Wireframe\WireframeFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WireframeController extends AbstractController
{
    private WireframeInterface $wf;

    public function __construct(
        private WireframeFactoryInterface $wfFactory,
    ) {
        $this->wf = $wfFactory->create('my_wireframe');
    }

    #[Route('/wireframe', name: 'app_wireframe')]
    public function index(): Response
    {
        $this->wf->reset();
        $this->dump();

        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'index',
        ]);
    }

    #[Route('/wireframe/input', name: 'app_wireframe_input')]
    public function input(): Response
    {
        $this->dump();

        if ($this->wf->isValid('visit')) {
            echo 'first access';
            $this->wf->update('visit');
        } else if ($this->wf->isValid('rewrite')) {
            echo 'rewrite';
            $this->wf->update('rewrite');
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

        if ($this->wf->isValid('write_out')) {
            echo 'write_out';
            $this->wf->update('write_out');
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

        if ($this->wf->isValid('submit')) {
            echo 'submit';
            $this->wf->update('submit');
        } else {
            echo 'NG';
        }

        return $this->render('wireframe/index.html.twig', [
            'controller_name' => 'result',
        ]);
    }

    public function dump()
    {
        $entity = $this->wf->getEntity();
        echo 'place:';
        var_dump($entity->getCurrentPlace());

        echo 'visit:';
        var_dump($this->wf->isValid('visit'));

        echo 'write_out:';
        var_dump($this->wf->isValid('write_out'));

        echo 'submit:';
        var_dump($this->wf->isValid('submit'));

        echo 'rewrite';
        var_dump($this->wf->isValid('rewrite'));
    }
}

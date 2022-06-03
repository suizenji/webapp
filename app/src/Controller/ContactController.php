<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(TranslatorInterface $translator): Response
    {
        return $this->_index($translator);
    }

    /**
     * @Route(
     *     "/{_locale}/contact",
     *     name="contact",
     *     requirements={
     *         "_locale": "en|jp",
     *     }
     * )
     */
    public function _index(TranslatorInterface $translator): Response
    {
        $translated = $translator->trans('MSG_A001');

        return $this->render('contact/index.html.twig', [
            'translated' => $translated,
        ]);
    }
}

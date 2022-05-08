<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\EnrollType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @see https://symfony.com/doc/current/doctrine.html
 * @see https://symfony.com/doc/current/the-fast-track/ja/14-form.html
 * @see https://symfony.com/doc/current/forms.html
 * @see https://symfony.com/doc/current/form/form_customization.html
 * @see https://symfony.com/doc/current/validation.html
 * @see https://symfony.com/doc/current/security.html#registering-the-user-hashing-passwords
 */
#[Route('/enroll', name: 'app_enroll_', methods: ['HEAD', 'GET'])]
class EnrollController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $pwh
    ) {
        // do nothing
    }

    #[Route('/input', name: 'input', methods: ['POST'])]
    public function input(Request $request): Response
    {
        $member = new Member();
        $form = $this->createForm(EnrollType::class, $member);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $this->pwh->hashPassword(
                $member,
                $member->getPlainPassword(),
            );
            $member->setPassword($hashedPassword);

            // TODO reopsitory
            // TODO unique check
            $this->em->persist($member);
            $this->em->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->renderForm('enroll/input.html.twig', [
            'form' => $form,
        ]);
    }
}

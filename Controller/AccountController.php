<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/profile', name: 'view_profile')]
    public function index(): Response
    {
        // DOES SAME THING AS
        // - { path: ^/profile, roles: ROLE_USER }
        // IN /config/packages/security.yaml
        // RESEARCH
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

//        $user = $this->getUser();

//        return new Response('Well hi there '.$user->getFirstName());
        return $this->render('profile.html.twig');
    }
}
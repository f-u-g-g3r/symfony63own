<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\LoginType;
use App\Form\Type\RegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{

    protected \Symfony\Component\HttpFoundation\Session\SessionInterface $session;

    public function __construct(private RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    #[Route('/reg_user', name: 'reg_form')]
    public function register (Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, Security $security): Response
    {
        $user = new User();

        $regForm = $this->createForm(RegistrationType::class, $user);



        $regForm->handleRequest($request);
        if ($regForm->isSubmitted() && $regForm->isValid()) {
            $user = $regForm->getData();

            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            $security->login($user);

            $this->session->set('uid', $user->getId());

            return $this->redirectToRoute('registration_success');
        }

        return $this->render('user/register.html.twig', [
            'regForm' => $regForm,
        ]);
    }


    #[Route('/log_user', name: 'app_login')]
    public function login (AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();



        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }


    #[Route('/home', name: "registration_success")]
    public function success(UserRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $fullname = $firstname." ".$lastname;

        return $this->render('home.html.twig', [
            'session' => $this->session,
            'fullname' => $fullname,
        ]);
    }
}
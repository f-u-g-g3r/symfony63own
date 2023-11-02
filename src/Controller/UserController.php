<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    protected \Symfony\Component\HttpFoundation\Session\SessionInterface $session;

    public function __construct(private RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    #[Route('/user', name: 'user_form')]
    public function new (Request $request, EntityManagerInterface $entityManager): Response
    {

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));
            $entityManager->persist($user);
            $entityManager->flush();

            $this->session->set('uid', $user->getId());

            return $this->redirectToRoute('registration_success');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/registration_success', name: "registration_success")]
    public function success(UserRepository $repository): Response
    {
        $user = $repository->find($this->session->get('uid'));

        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $fullname = $firstname." ".$lastname;

        return $this->render('home.html.twig', [
            'session' => $this->session,
            'fullname' => $fullname,
        ]);
    }
}
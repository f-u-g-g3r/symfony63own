<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\AST\Functions\CurrentDateFunction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $post->setPostedAt(new \DateTimeImmutable);
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('list_posts');
        }


        return $this->render('post/index.html.twig', [
            'postForm' => $form->createView(),
        ]);
    }

    #[Route('/post/list', name: 'list_posts')]
    public function listPosts(EntityManagerInterface $entityManager)
    {
        $posts = $entityManager->getRepository(Post::class)->findAll();
        return $this->render('post/list.html.twig', [
            'posts' => $posts,
        ]);
    }
}

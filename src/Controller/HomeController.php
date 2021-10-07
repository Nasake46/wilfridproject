<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home/list", name="home_list")
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/home/new", name="home_new")
     */
    public function addHome(): Response
    {
        return $this->render('home/new.html.twig');
    }

    /**
     * @Route("/home/list/{type}", name="home_show")
     */
    public function showHome(string $type): Response
    {
        return $this->render('home/list_home.html.twig', [
            "type" => $type
        ]);
    }

     /**
     * @Route("/home/type", name="home_type")
     */
    public function typeHome(): Response
    {
        $types = ['Feu', 'Eau', 'Plante'];
        return $this->render('home/type.html.twig', [
            "types" => $types
        ]);
    }

    /**
     * @Route("/home/article/new", name="home_artcle")
     */
    public function addArticle(): Response
    {
        $article = new Article();
        $article->setTitle('Epitech Digital : Rentré');
        $article->setContent('Yeah baby, thats what i had waiting for');
        $article->setAuthorName('Nasake');

        $comment = new Comment();
        $comment->setContent('hevliqz');
        $comment->setCreatedAt(new \DateTimeImmutable());

        $article->addComment($comment);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->persist($comment);
        $entityManager->flush();

        return $this->json([
            'types' => 200,
            'message' => 'Article created !'
        ]);
    }
}

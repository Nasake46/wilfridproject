<?php

namespace App\Controller;

use App\Form\ArticleFormType;
use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

    #[Route('/home/article/pipou', name: 'article_new')]
    public function formAddArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }


        return $this->renderForm('home/new.html.twig', [
            'articleForm' => $form
        ]);
    }

    /**
     * @Route("/home/article/list", name="article_list")
     */
    public function getArticle(): Response
    {

        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findAll();

        return $this->render('home/article/new.html.twig', [
            'articles' => $articles
        ]);
    }

    
}

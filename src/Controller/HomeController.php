<?php

namespace App\Controller;

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
}

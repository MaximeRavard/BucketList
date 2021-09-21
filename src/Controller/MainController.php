<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home_front")
     */
    public function index(): Response
    {
        die('Hello world !!!');
        /*        return $this->render('main/index.html.twig', [
                   'controller_name' => 'MainController',
                ]);*/
    }

    /**
     * @Route ("/home", name="home")
     */
    public function home(): Response
    {
        $fruits = ["Orange" , "Pomme", "Kiwi"];

        return $this->render('main/home.html.twig');
    }

    /**
     * @Route ("/aboutus", name="aboutus")
     */
    public function aboutUs(): Response
    {
        $tab[0]["prenom"] ="Tom";
        $tab[0]["nom"] ="CRUISE";
        $tab[1]["nom"] ="CAGE";
        $tab[1]["prenom"] ="Nicolas";
        $tab[2]["prenom"] ="Bruce";
        $tab[2]["nom"] ="Willis";
        return $this->render('main/aboutus.html.twig', ['personnes' => $tab]);
    }

    /**
     * @Route ("/test/demo/contact", name="demo_contact")
     */
    public function contact(): Response
    {
        return $this->json(["contact" => "0695282478"]);
    }
}

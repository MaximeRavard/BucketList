<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wishlist")
     */
    public function index(WishRepository $repo): Response
    {
        $result = $repo->findAll();
        return $this->render('wish/wishlist.html.twig', [
            'wishListResult' => $result
        ]);
    }

    /**
     * @Route("/wishDetail/{id}", name="wishDetail")
     */
    public function wishDetail(Wish $wish): Response
    {
        return $this->render('wish/wishDetail.html.twig', [
            'wishResult' => $wish
        ]);
    }

}

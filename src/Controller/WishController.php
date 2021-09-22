<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @Route("/wishRemove/{id}", name="wishRemove")
     */
    public function wishRemove(Wish $wish, EntityManagerInterface $em): Response
    {
        $em->remove($wish);
        $em->flush();
        return $this->redirectToRoute('wishlist');
    }

    /**
     * @Route("/wishAddDure/", name="wishAddDure")
     */
    public function wishAddDure(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $wish = new Wish();
        $wish->setTitle('Avoir une tesla');
        $wish->setAuthor('Maxime');
        $wish->setDescription('Dinguerie la teslaaaa');
        $wish->setDateCreated(new \DateTime('now'));
        $em->persist($wish);
        $em->flush();
        return $this->redirectToRoute('wishlist');

    }

    /**
     * @Route("/wishAdd/", name="wishAdd")
     */
    public function wishAdd(Request $request): Response
    {
        $wish = new Wish();
        $formWish = $this->createForm(WishType::class, $wish);

        $formWish->handleRequest($request);
        if($formWish->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($wish);
            $em->flush();
            return $this->redirectToRoute('wishlist');

        }
        return $this->render('wish/ajouter.html.twig', [
            'wishForm' => $formWish->createView()
        ]);

    }

}

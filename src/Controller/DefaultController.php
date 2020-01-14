<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function home(ProductRepository $productRepository): Response
    {
        return $this->render('home.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
       
}

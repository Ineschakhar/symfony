<?php

namespace App\Controller;

use App\Entity\ProductToSell;
use App\Form\ProductToSellType;
use App\Repository\ProductToSellRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/to/sell")
 */
class ProductToSellController extends AbstractController
{
    /**
     * @Route("/", name="product_to_sell_index", methods={"GET"})
     */
    public function index(ProductToSellRepository $productToSellRepository): Response
    {
        return $this->render('product_to_sell/index.html.twig', [
            'product_to_sells' => $productToSellRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_to_sell_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $productToSell = new ProductToSell();
        $form = $this->createForm(ProductToSellType::class, $productToSell);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productToSell);
            $entityManager->flush();

            return $this->redirectToRoute('product_to_sell_index');
        }

        return $this->render('product_to_sell/new.html.twig', [
            'product_to_sell' => $productToSell,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_to_sell_show", methods={"GET"})
     */
    public function show(ProductToSell $productToSell): Response
    {
        return $this->render('product_to_sell/show.html.twig', [
            'product_to_sell' => $productToSell,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_to_sell_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProductToSell $productToSell): Response
    {
        $form = $this->createForm(ProductToSellType::class, $productToSell);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_to_sell_index');
        }

        return $this->render('product_to_sell/edit.html.twig', [
            'product_to_sell' => $productToSell,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_to_sell_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProductToSell $productToSell): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productToSell->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productToSell);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_to_sell_index');
    }
}

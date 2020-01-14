<?php

namespace App\Controller;

use App\Entity\Comission;
use App\Form\ComissionType;
use App\Repository\ComissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comission")
 */
class ComissionController extends AbstractController
{
    /**
     * @Route("/", name="comission_index", methods={"GET"})
     */
    public function index(ComissionRepository $comissionRepository): Response
    {
        return $this->render('comission/index.html.twig', [
            'comissions' => $comissionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="comission_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comission = new Comission();
        $form = $this->createForm(ComissionType::class, $comission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comission);
            $entityManager->flush();

            return $this->redirectToRoute('comission_index');
        }

        return $this->render('comission/new.html.twig', [
            'comission' => $comission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comission_show", methods={"GET"})
     */
    public function show(Comission $comission): Response
    {
        return $this->render('comission/show.html.twig', [
            'comission' => $comission,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comission_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comission $comission): Response
    {
        $form = $this->createForm(ComissionType::class, $comission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comission_index');
        }

        return $this->render('comission/edit.html.twig', [
            'comission' => $comission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comission_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Comission $comission): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comission->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comission_index');
    }
}

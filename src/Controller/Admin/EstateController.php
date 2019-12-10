<?php

namespace App\Controller\Admin;

use App\Entity\Estate;
use App\Form\EstateType;
use App\Repository\EstateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/estate")
 */
class EstateController extends AbstractController
{
    /**
     * @Route("/", name="admin_estate_index", methods={"GET"})
     */
    public function index(EstateRepository $estateRepository): Response
    {
        return $this->render('admin/estate/index.html.twig', [
            'estates' => $estateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_estate_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estate = new Estate();
        $form = $this->createForm(EstateType::class, $estate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estate);
            $entityManager->flush();

            return $this->redirectToRoute('admin_estate_index');
        }

        return $this->render('admin/estate/new.html.twig', [
            'estate' => $estate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_estate_show", methods={"GET"})
     */
    public function show(Estate $estate): Response
    {
        return $this->render('admin/estate/show.html.twig', [
            'estate' => $estate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_estate_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estate $estate): Response
    {
        $form = $this->createForm(EstateType::class, $estate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_estate_index');
        }

        return $this->render('admin/estate/edit.html.twig', [
            'estate' => $estate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_estate_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Estate $estate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_estate_index');
    }
}

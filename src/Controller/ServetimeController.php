<?php

namespace App\Controller;

use App\Entity\Servetime;
use App\Form\ServetimeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/servetime")
 */
class ServetimeController extends AbstractController
{
    /**
         * @Route("/", name="app_servetime_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $servetimes = $entityManager
            ->getRepository(Servetime::class)
            ->findAll();

        return $this->render('servetime/index.html.twig', [
            'servetimes' => $servetimes,
        ]);
    }

    /**
     * @Route("/new", name="app_servetime_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $servetime = new Servetime();
        $form = $this->createForm(ServetimeType::class, $servetime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($servetime);
            $entityManager->flush();

            return $this->redirectToRoute('app_servetime_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('servetime/new.html.twig', [
            'servetime' => $servetime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_servetime_show", methods={"GET"})
     */
    public function show(Servetime $servetime): Response
    {
        return $this->render('servetime/show.html.twig', [
            'servetime' => $servetime,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_servetime_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Servetime $servetime, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServetimeType::class, $servetime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_servetime_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('servetime/edit.html.twig', [
            'servetime' => $servetime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_servetime_delete", methods={"POST"})
     */
    public function delete(Request $request, Servetime $servetime, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$servetime->getId(), $request->request->get('_token'))) {
            $entityManager->remove($servetime);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_servetime_index', [], Response::HTTP_SEE_OTHER);
    }
}

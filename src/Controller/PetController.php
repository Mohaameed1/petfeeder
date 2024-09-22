<?php

namespace App\Controller;

use App\Entity\Pet;
use App\Repository\PetRepository;
use App\Form\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pet")
 */
class PetController extends AbstractController
{
    /**
     * @Route("/", name="app_pet_index", methods={"GET"})
     */
    public function index(PetRepository $pets,Request $request,PaginatorInterface $paginator): Response
    {

        $donnees = $this->getDoctrine()->getRepository(Pet::class)->findBy([],['nom' => 'desc']);
        $pets = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4// Nombre de résultats par page



        );


        return $this->render('pet/index.html.twig', [
            'pets' => $pets,
        ]);
    }

    /**
     * @Route("/new", name="app_pet_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pet = new Pet();
        $form = $this->createForm(PetType::class, $pet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pet);
            $entityManager->flush();

            return $this->redirectToRoute('app_pet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pet/new.html.twig', [
            'pet' => $pet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_pet_show", methods={"GET"})
     */
    public function show(Pet $pet): Response
    {
        return $this->render('pet/show.html.twig', [
            'pet' => $pet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pet_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pet $pet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PetType::class, $pet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pet/edit.html.twig', [
            'pet' => $pet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_pet_delete", methods={"POST"})
     */
    public function delete(Request $request, Pet $pet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pet_index', [], Response::HTTP_SEE_OTHER);
    }
}

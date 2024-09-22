<?php

namespace App\Controller;

use App\Entity\Systeme;
use App\Form\SystemeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/systeme")
 */
class SystemeController extends AbstractController
{
    /**
     * @Route("/", name="app_systeme_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $systemes = $entityManager
            ->getRepository(Systeme::class)
            ->findAll();

        return $this->render('systeme/index.html.twig', [
            'systemes' => $systemes,
        ]);
    }

    /**
     * @Route("/new", name="app_systeme_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $systeme = new Systeme();
        $form = $this->createForm(SystemeType::class, $systeme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($systeme);
            $entityManager->flush();

            return $this->redirectToRoute('app_systeme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('systeme/new.html.twig', [
            'systeme' => $systeme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_systeme_show", methods={"GET"})
     */
    public function show(Systeme $systeme): Response
    {
        return $this->render('systeme/show.html.twig', [
            'systeme' => $systeme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_systeme_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Systeme $systeme, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SystemeType::class, $systeme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_systeme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('systeme/edit.html.twig', [
            'systeme' => $systeme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_systeme_delete", methods={"POST"})
     */
    public function delete(Request $request, Systeme $systeme, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$systeme->getId(), $request->request->get('_token'))) {
            $entityManager->remove($systeme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_systeme_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/imprimer", name="system_imp", methods={"GET"})
     */
    public function ConvertPDF(Systeme $systeme): Response
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('systeme/imp.html.twig', [
            'Systeme'=> $systeme
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        $options = new Options();

        $options->setIsRemoteEnabled(true);

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false



        ]);


    }
}

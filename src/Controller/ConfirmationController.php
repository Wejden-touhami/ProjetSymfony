<?php

namespace App\Controller;

use App\Entity\Confirmation;
use App\Form\ConfirmationType;
use App\Repository\ConfirmationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/confirmation")
 */
class ConfirmationController extends AbstractController
{
    /**
     * @Route("/", name="confirmation_index", methods={"GET"})
     */
    public function index(ConfirmationRepository $confirmationRepository): Response
    {
        return $this->render('confirmation/index.html.twig', [
            'confirmations' => $confirmationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="confirmation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $confirmation = new Confirmation();
        $form = $this->createForm(ConfirmationType::class, $confirmation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($confirmation);
            $entityManager->flush();

            return $this->redirectToRoute('confirmation_index');
        }

        return $this->render('confirmation/new.html.twig', [
            'confirmation' => $confirmation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="confirmation_show", methods={"GET"})
     */
    public function show(Confirmation $confirmation): Response
    {
        return $this->render('confirmation/show.html.twig', [
            'confirmation' => $confirmation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="confirmation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Confirmation $confirmation): Response
    {
        $form = $this->createForm(ConfirmationType::class, $confirmation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('confirmation_index');
        }

        return $this->render('confirmation/edit.html.twig', [
            'confirmation' => $confirmation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="confirmation_delete", methods={"POST"})
     */
    public function delete(Request $request, Confirmation $confirmation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$confirmation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($confirmation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('confirmation_index');
    }
}

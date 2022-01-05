<?php

namespace App\Controller\Deal;

use App\Entity\Deal;
use App\Form\Deal\DealType;
use App\Repository\Deal\DealRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/deals", name="deal:")
 */
class DealController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(DealRepository $dealRepository): Response
    {
        return $this->render('deal/deal/index.html.twig', [
            'deals' => $dealRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $deal = new Deal();
        $form = $this->createForm(DealType::class, $deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($deal);
            $entityManager->flush();

            return $this->redirectToRoute('deal:index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('deal/deal/new.html.twig', [
            'deal' => $deal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Deal $deal): Response
    {
//        dump($deal);

        return $this->render('deal/deal/show.html.twig', [
            'deal' => $deal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Deal $deal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DealType::class, $deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('deal:index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('deal/deal/edit.html.twig', [
            'deal' => $deal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Deal $deal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($deal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('deal:index', [], Response::HTTP_SEE_OTHER);
    }
}

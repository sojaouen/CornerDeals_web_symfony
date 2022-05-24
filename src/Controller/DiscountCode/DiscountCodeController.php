<?php

namespace App\Controller\DiscountCode;

use App\Entity\DiscountCode\DiscountCode;
use App\Form\DiscountCode\DiscountCodeType;
use App\Repository\DiscountCode\DiscountCodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/discount-code", name="discount_code:")
 */
class DiscountCodeController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(DiscountCodeRepository $discountCodeRepository): Response
    {
        return $this->render('discount_code/discount_code/index.html.twig', [
            'discount_codes' => $discountCodeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $discountCode = new DiscountCode();
        $form = $this->createForm(DiscountCodeType::class, $discountCode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($discountCode);
            $entityManager->flush();

            return $this->redirectToRoute('discount_code:index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('discount_code/discount_code/new.html.twig', [
            'discount_code' => $discountCode,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(DiscountCode $discountCode): Response
    {
        return $this->render('discount_code/discount_code/show.html.twig', [
            'discount_code' => $discountCode,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DiscountCode $discountCode, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DiscountCodeType::class, $discountCode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('discount_code:index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('discount_code/discount_code/edit.html.twig', [
            'discount_code' => $discountCode,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, DiscountCode $discountCode, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$discountCode->getId(), $request->request->get('_token'))) {
            $entityManager->remove($discountCode);
            $entityManager->flush();
        }

        return $this->redirectToRoute('discount_code:index', [], Response::HTTP_SEE_OTHER);
    }
}

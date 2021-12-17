<?php

namespace App\Controller\PriceComparison;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/price-comparison", name="price_comparison")
 */
class PriceComparisonController extends AbstractController
{
    /**
     * @Route("", name=":index")
     */
    public function index(): Response
    {
        return $this->render('price_comparaison/index.html.twig', [
            'controller_name' => 'PriceComparaisonController',
        ]);
    }
}

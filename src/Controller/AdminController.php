<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Deal\DealRepository;
use App\Entity\Deal;
use App\Entity\Category;
use App\Form\Deal\DealType;

class AdminController extends AbstractController
{
//    Méthode permettant d'afficher l'accueil du BackOffice
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * Méthode permettant d'afficher toute la liste des articles sous formes de tableau HTML dans le BackOffice
     * 2ème route pour supprimer un deal existant de la BDD
     *
     * @Route("/admin/deals", name="admin_deals")
     * @Route("/admin/{id}/remove", name="admin_remove_deal")
     */

    public function adminDeals(EntityManagerInterface $manager, DealRepository $repoDeal, Deal $deal = null): Response
    {
// Le manager permet de manipuler le BDD, on execute la méthode getClassMetadata() afin de sélectionner les méta données des colonnes
// (primary key, not nul, type, taille etc...)
// getFieldNames () permet de recupérer le noms des champs/colonnes de la table Deal de la bdd
// $column = $data-›getColumnMeta()-> $column[ 'name' ] -- DESC deal-› fetch-> array($column['Field'])
        $columns = $manager->getClassMetadata(Deal::class) ->getFieldNames();

        dump($columns);

// Selection de tous les deals en BDD
        $deals = $repoDeal ->findAll(); // SELECT * FROM deal + FETCH_ALL

        dump($deals);

        if($deal)
        {
            // avant la suppression, on stocke l'id du deal à supprimer dans une variable afin de l'injecter dans le message de validation
            $id = $deal->getId();

            $manager ->remove($deal);
            $manager ->flush();

            $this->addFlash('success', "le deal nº$id a bien été supprimé");

            return $this->redirectToRoute('admin_deals');
        }

        return $this ->render('admin/admin_deals.html.twig', [
                'columns' => $columns, // on transmet à la méthode render le nom des champs/colonnes selectionnées en BDD afin de pouvoir les
// receptionner sur le template et de pouvoir les afficher
                'dealsBdd' => $deals // on transmet à la méthode render les deals selectionnés en BDD au template afin de pouvoir les
// afficher
            ]);
    }

    /**
     * Méthode permettant de modifier un deal existant dans le backoffice
     *
     * @Route("/admin/{id}/edit-deal", name="admin_edit_deal")
     */

    public function adminEditDeal(Deal $deal, Request $request, EntityManagerInterface $manager)
    {
        dump($deal);

        // On crée un formulaire via la classe DealType qui a pour but de remplir l'entité $deal
        $formDeal = $this ->createForm(DealType::class, $deal);

        dump($request);

        $formDeal->handleRequest($request); // $ POST['title'] --> $deal-›setTitle($ POST['title'])

        if($formDeal->isSubmitted() && $formDeal->isValid())
        {
            $manager->persist($deal);
            $manager->flush();

            $this->addFlash('success', "le deal nº" . $deal->getID() . " a bien été modifié");

            return $this->redirectToRoute('admin_deals');
        }

        return $this->render('admin/admin_edit_deal.html.twig',[
            'idDeal' => $deal->getId(),
            'formDeal' => $formDeal->createView()
        ]);
    }

    /**
     * Méthode permettant d'afficher sous forme de tableau HTML les catégories stockées en BDD
     *
     * @Route("/admin/categories", name="admin_category")
     * @Route("/admin/category/{id}/remove", name="admin_remove_category")
     */
    public function adminCategory(): Response
    {
        return $this->render('admin/admin_category.html.twig');
    }

    /**
     * @Route("/admin/category/new, name="admin_new_category")
     * @Route("/admin/category/{id}/edit", name="admin_edit_category")
     */
    public function adminFormCategory()
    {
        return $this->render('admin/admin_form_category.html.twig');
    }
}


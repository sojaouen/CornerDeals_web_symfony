<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Deal;
use App\Entity\User;
use App\Form\Category\CategoryType;
use App\Form\Comment\CommentType;
use App\Form\Deal\DealType;
use App\Form\AdminRegistrationFormType;
use App\Repository\Category\CategoryRepository;
use App\Repository\Comment\CommentRepository;
use App\Repository\Deal\DealRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
// Le manager permet de manipuler la BDD, on execute la méthode getClassMetadata() afin de sélectionner les méta données des colonnes
// (primary key, not nul, type, taille etc...)
// getFieldNames () permet de recupérer le noms des champs/colonnes de la table Deal de la bdd
// $column = $data-›getColumnMeta()-> $column[ 'name' ] -- DESC deal-› fetch-> array($column['Field'])
        $columns = $manager->getClassMetadata(Deal::class)->getFieldNames();

        dump($columns);

// Selection de tous les deals en BDD
        $deals = $repoDeal->findAll(); // SELECT * FROM deal + FETCH_ALL

        dump($deals);

        if ($deal) {
            // avant la suppression, on stocke l'id du deal à supprimer dans une variable afin de l'injecter dans le message de validation
            $id = $deal->getId();

            $manager->remove($deal);
            $manager->flush();

            $this->addFlash('success', "le deal nº$id a bien été supprimé");

            return $this->redirectToRoute('admin_deals');
        }

        return $this->render('admin/admin_deals.html.twig', [
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
        $formDeal = $this->createForm(DealType::class, $deal);

        dump($request);

        $formDeal->handleRequest($request); // $ POST['title'] --> $deal-›setTitle($ POST['title'])

        if ($formDeal->isSubmitted() && $formDeal->isValid()) {
            $manager->persist($deal);
            $manager->flush();

            $this->addFlash('success', "le deal nº" . $deal->getID() . " a bien été modifié");

            return $this->redirectToRoute('admin_deals');
        }

        return $this->render('admin/admin_edit_deal.html.twig', [
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
    public function adminCategory(EntityManagerInterface $manager, CategoryRepository $repoCategory, Category $category = null): Response
    {
        $columns = $manager->getClassMetadata(Category::class)->getFieldNames();

        dump($columns);
        dump($category);

        // Si la variable $category retourne TRUE, cela veut dire qu'elle contient une catégorie de la BDD, alors on entre dans le IF et on tente d'executer la suppression

        if ($category) {
            // Il y a une relation entre la table Deal et Category et une contrainte d'intégrité en RESTRICT
            // Donc il est impossible de supprimer la catégorie si 1 deal lui est toujours associé
            // getDeals() de l'entité Category retourne tous les artciles asssociés à la catégorie (relation bi-directionnelle)
            // Si getDeals() retourne un résultat vide, cela veut dire qu'il n'y a plus aucun deal associé à la catégorie, il est donc possible de la supprimer
            if ($category->getDeals()->isEmpty()) {
                $manager->remove($category);
                $manager->flush();

                $this->addFlash('success', "La catégorie " . $category->getName() . " a été supprimée avec succès !");
            } else // si des deals sont toujours associés à la catégorie on envoie un message d'erreur à l'utilisateur
            {
                $this->addFlash('danger', "Il n'est pas possible de supprimer la catégorie" . $category->getName() . " car un ou plusieurs deals lui sont toujours associés");
            }

            return $this->redirectToRoute('admin_category');
        }

        $categoryBdd = $repoCategory->findAll(); // SELECT * FROM category + FETCH_ALL

        dump($categoryBdd);

        return $this->render('admin/admin_category.html.twig', [
            'columns' => $columns,
            'categoryBdd' => $categoryBdd
        ]);
    }

    /**
     * @Route("/admin/category/new", name="admin_new_category")
     * @Route("/admin/category/{id}/edit", name="admin_edit_category")
     */
    public function adminFormCategory(Request $request, EntityManagerInterface $manager, Category $category = null): Response
    {
        // Si l' objet entité $category est null, cela veut dire que nous sommes sur la route '/admin/
        // category/new', que nous souhaitons créer une nouvelle catégorie, alors on entre dans la condition IF
        // Si l'objet entité $category return true, cela veut dire que nous sommes sur la route "/admin/category/{id}/
        // edit", l'id envoyé dans l'URL a été selectionné en BDD, nous souhaitons modifier la catégorie existante
        if (!$category) {
            $category = new Category;
        }

        $formCategory = $this->createForm(CategoryType::class, $category, [
            'validation_groups' => ['category']
        ]); // getForm()

        dump($request);

        $formCategory->handleRequest($request); //$_POST[ 'title'] --› envoi dans--›setTitle($_POST['title'])

        dump($category);

        if ($formCategory->isSubmitted() && $formCategory->isValid()) {
            if (!$category->getId()) {
                $message = "La catégorie " . $category->getName() . " a été enregistrée avec succès !";
            } else {
                $message = "La catégorie " . $category->getName() . " a été modifiée avec succès !";
            }
            $manager->persist($category); // on prépare et on garde en mémoire la requete INSERT
            $manager->flush();

            // On définit un message de validation après l'execution de la requete SQL INSERT
            $this->addFlash('success', $message);

            // Après l'execution de la requête INSERT, on redirige l'utilisateur vers l'affichage des catégories dans le BackOffice
            return $this->redirectToRoute('admin_category');
        }

        return $this->render('admin/admin_form_category.html.twig', [
            'formCategory' => $formCategory->createView()
        ]);
    }

    /**
     * Méthode permettant d'afficher et de supprimer tous les commentaires des articles stockés en BDD
     * Méthode permettant de supprimer un commentaire en BDD
     *
     * @Route("/admin/comments", name="admin_comments")
     * @Route ("/admin/comments/{id}/remove", name="admin_remove_comment")
     */

    public function adminComment(EntityManagerInterface $manager, CommentRepository $repoComment, Comment $comment = null): Response
    {
        $columns = $manager->getClassMetadata(Comment::class)->getFieldNames();

        dump($columns);

        $commentsBdd = $repoComment->findAll();

        dump($commentsBdd);
        dump($comment);

        if ($comment) {
            // On stock l'id du commentaire supprimer avant d' executer la requete DELETE afin d'injecter 1'id du
            // commentaire dans le message de validation
            $id = $comment->getId();

            $manager->remove($comment); // on prépare et on garde en mémoire la requête de suppression (DELETE)
            $manager->flush(); // on exécute la requête de suppression

            $this->addFlash('success', "Le commentaire nº$id a été supprimé avec succès !");

            // Après la suppression, on redirige l'utilisateur vers l'affichage des commentaires
            return $this->redirectToRoute('admin_comments');
        }

        return $this->render('admin/admin_comments.html.twig', [
            'columns' => $columns,
            'commentsBdd' => $commentsBdd
        ]);
    }

    /**
     * Méthode permettant de modifier un commentaire en BDD
     *
     * @Route ("/admin/comment/{id}/edit", name="admin_edit_comment")
     */

    public function editComment(Comment $comment, Request $request, EntityManagerInterface $manager): Response
    {
        dump($comment);

        // On crée un formulaire via la classe CommentType qui a pour but de remplir l'entité $comment
        $formComment = $this->createForm(CommentType::class, $comment);

        dump($request);

        $formComment->handleRequest($request); // $ POST['title'] --> $comment-›setTitle($ POST['title'])

        if ($formComment->isSubmitted() && $formComment->isValid()) {
            // Récupération des informations à injecter dans le message de validation
            $id = $comment->getId();

            $manager->persist($comment);
            $manager->flush();

            $this->addFlash('success', "le commentaire nº$id a bien été modifié avec succès !");

            return $this->redirectToRoute('admin_comments');
        }

        return $this->render('admin/admin_edit_comment.html.twig', [
            'idComment' => $comment->getId(),
            'formComment' => $formComment->createView()
        ]);


        return $this->render('admin/admin_edit_comment.html.twig');
    }

    /**
     * Méthode permettant d'afficher les utilisateurs stockés en BDD sous forme de tableau HTML
     * Méthode permettant de supprimer un utilisateur en BDD
     *
     * @Route ("/admin/users", name="admin_users")
     * @Route ("/admin/user/{id}/remove", name="admin_remove_user")
     */
    public function adminUsers(EntityManagerInterface $manager, UserRepository $repoUser, User $user = null): Response
    {
        // On récupère les noms des champs / colonnes de la table User
        $columns = $manager->getClassMetadata(User::class)->getFieldNames();

        dump($columns);

        // On selectionne en BDD toute la table 'user'
        $usersBdd = $repoUser->findAll();

        dump($usersBdd);
        dump($user);

        // Si la condition IF renvoie TRUE, cela veut dire que l'objet entity $user contient un utilisateur stocké en BDD
        // que nous allons supprimer
        if($user)
        {
            // On prépare et en garde en mémoire la requete de suppression DELETE
            $manager->remove($user);
            // On execute la requete de suppression en BDD
            $manager->flush();

            // ON définit un message de validation de suppression en session
            $this->addFlash('success', "L'utilisateur a été supprimé avec succès !");

            return $this->redirectToRoute('admin_users');
        }


        return $this->render('admin/admin_users.html.twig', [
            'columns' => $columns,
            'usersBdd' => $usersBdd
        ]);
    }

    /**
     * Méthode permettant de modifier un utilisateur en Bdd
     *
     * @Route ("/admin/user/{id}/edit", name="admin_edit_user")
     */
    public function adminUserEdit(User $user, EntityManagerInterface $manager, Request $request): Response
    {
        dump($user);

        $formUser = $this->createForm(AdminRegistrationFormType::class, $user);

        $formUser->handleRequest($request); // $_POST['username'] --> $user->setUsername($_POST['username'])

        if($formUser->isSubmitted() && $formUser->isValid())
        {
            $id = $user->getId();
            $firstname = $user->getFirstname();
            $lastname = $user->getLastname();

            $manager->persist($user); // On prépare et on garde en mémoire la requête de modification UPDATE
            $manager->flush(); // on execute la requête SQL UPDATE en BDD

            // On définit le message de validation de modification en session
            $this->addFlash('success', "L'utilisateur Nº$id - $firstname $lastname a été modifié avec succès");

            // On redirige l'utilisateur après la modification
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/admin_edit_user.html.twig', [
            'formUser' => $formUser->createView()
        ]);
    }
}



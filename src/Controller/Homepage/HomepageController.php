<?php

namespace App\Controller\Homepage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
}

//class HomepageController extends AbstractController
//{
//    /**
//     * @Route("/", name="homepage")
//     */
//    public function index(): Response
//    {
//        return $this->render('homepage/index.html.twig', [
//            'controller_name' => 'HomepageController',
//            'deals' => $deals
//        ]);
//    }
//
//    /** Méthode permettant d'insérer et de modifier un deal
//     *
//     * @Route("/deal/new", name="deal:new")
//     */
//    public function create(Request $request, EntityManagerInterface $manager): Response
//    {
//        // la classe Request de Symfony permet de véhiculer les données des superglobales PHP ($ POST, $ FILES, $ COOKIE, $ SESSION)
//        // $request est un objet issu de 1a classe Request injecté en dependance de la méthode create()
//
////        dump($request);
////
////        if($request->request->count() > 0)
////        {
////            $dealCreate = new Deal;
////
////            $dealCreate->setTitle($request->request->get('title'))
////                        ->setDescription($request->request->get('description'))
////                        ->setDealPrice($request->request->get('dealPrice'))
////                        ->setImage($request->request->get('image'))
////                        ->setStartAt(new \DateTime);
////
////            dump ($dealCreate);
////
////            $manager->persist($dealCreate);
////
////            $manager->flush();
////
////            // Après l'insertion on redirige l'internaute vers le détail du deal qui vient d'être inséré en BDD
////            return $this->redirectToRoute('deal:show',[
////                'id'=> $dealCreate->getId()
////            ]);
////        }
//
//        $dealCreate = new Deal;
//
//        $form = $this->createFormBuilder($dealCreate);
//                    ->add()
//
//        return $this - ›render('deal/deal/new.html.twig');
//    }
//
//    /** Méthode permettant d'afficher le détail d'un deal
//     * On définit ici une route paramétrée, une route définit avec un ID qui va receptionnée un ID d'un deal dans 1 'URL
//     *  /deal/9--› {id}--> $id = 1
//     *
//     * @Route("/deal/{id}", name="deal:show")
//     */
//    public function show(Deal $deal): Response
//    {
//// $repoDeal est un objet issu de la classe DealRepository
//// $repoDeal = $this-›getDoctrine()-›getRepository (Deal:: class);
//// dump ($repoDeal);
//// dump ($id); // id=3
//// On transmet à la méthode find() de 1a classe DealRepository l'id recupéré dans 1' URL est transmis en argument de la fonction show
//// ($id) | $id = 3
//// La méthode find() permet de selectionner en BDD un deal par son ID
//// $deal = $repoDeal-›find($id);
//
//        dump($deal);
//
//        return $this - ›render('deal/deal/show.html.twig', [
//                'dealTwig' => $deal // on envoie sur le template les données selectionnées en BDD, c'est à dire les informations d'1 deal en
//// fonction 1' id transmis dans 1 'URL
//            ]);
//    }
////    /**
////    * Méthode permettant d'afficher toute le liste des deals stockés en BDD
////    * @Route("/", name="homepage")
////    */
////    public function index(DealRepository $repo): Response
////    {
////        $repo = $this-›getDoctrine()-›getRepository (Deal::class);
////
////        dump($repo);
////        $deals = $repo-›findAll(); // equivalent de SELECT * FROM deal + fetchAll
////    }
//}

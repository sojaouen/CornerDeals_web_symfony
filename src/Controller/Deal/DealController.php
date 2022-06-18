<?php

namespace App\Controller\Deal;

use App\Entity\Deal\Deal;
use App\Form\Deal\DealType;
use App\Service\DealService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/deals", name="deal:")
 */
class DealController extends AbstractController
{
    private $dealService;

    public function __construct(DealService $dealService, ManagerRegistry $doctrine)
    {
        $this->dealService = $dealService;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $query = $request->query->get('q');
        $sort = $request->query->get('sort');

        $deals = $this->dealService->buildResult($query, $sort);

        return $this->render('deal/deal/list.html.twig', [
            'deals' => $deals,
            'query' => $query
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $deal = new Deal();
        $form = $this->createForm(DealType::class, $deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $deal->setOwner($this->getUser());

            /** @var UploadedFile $illustrationFile */
            $illustrationFile = $form->get('illustration')->getData(); // permet de récupérer les données de l'image uploadée
            dump($illustrationFile);

            if ($illustrationFile) {
                $originalFilename = pathinfo($illustrationFile->getClientOriginalName(), PATHINFO_FILENAME);
//                dump($originalFilename); // permet de récupèrer le nom du fichier

                $safeFilename = $slugger->slug($originalFilename);
//                dump($safeFilename);

                $newFilename = $safeFilename . '-' . uniqid() . '.' . $illustrationFile->guessExtension();

                try // on tente de copier l'image dans le bon dossier du serveur
                {
                    $illustrationFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    #TODO Notification, upload impossible
                }
                // On envoie l'image définitive dans le bon setter de l'objet afin que l'image soit stockée en BDD
                $deal->setIllustration($newFilename);
            }

            $entityManager->persist($deal);
            $entityManager->flush();

            return $this->redirectToRoute('deal:show', [
                'id' => $deal->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('deal/deal/new.html.twig', [
            'deal' => $deal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"}, requirements={"id"="\d+"})
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
        if ($this->isCsrfTokenValid('delete' . $deal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($deal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('deal:index', [], Response::HTTP_SEE_OTHER);
    }
}

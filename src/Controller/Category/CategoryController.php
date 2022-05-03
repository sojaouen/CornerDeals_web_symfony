<?php

namespace App\Controller\Category;

use App\Entity\Category;
use App\Form\Category\CategoryType;
use App\Repository\Category\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/category", name="category:")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $illustrationFile */
            $illustrationFile = $form->get('illustration')->getData(); // permet de récupérer les données de l'image uploadée
            dump($illustrationFile);

            if($illustrationFile)
            {
                $originalFilename = pathinfo($illustrationFile->getClientOriginalName(), PATHINFO_FILENAME);
                dump($originalFilename); // permet de récupèrer le nom du fichier

                $safeFilename = $slugger->slug($originalFilename);
                dump($safeFilename);

                $newFilename = $safeFilename . '-' . uniqid() . '.' . $illustrationFile->guessExtension();

                try // on tente de copier l'image dans le bon dossier du serveur
                {
                    $illustrationFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                }
                catch(FileException $e)
                {
                    #TODO Notification, upload impossible
                }
                // On envoie l'image définitive dans le bon setter de l'objet afin que l'image soit stockée en BDD
                $category->setIllustration($newFilename);
            }

            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category:index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category/category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Category $category): Response
    {
        return $this->render('category/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('category:index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category/category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
    }
}

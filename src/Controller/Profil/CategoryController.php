<?php

namespace App\Controller\Profil;

use App\Entity\Categories;
use App\Form\CategoriesForm;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profil/category')]
final class CategoryController extends AbstractController
{
    #[Route(name: 'app_profil_category_index', methods: ['GET'])]
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('profil_category/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_profil_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Categories();
        $form = $this->createForm(CategoriesForm::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profil_category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profil_category_show', methods: ['GET'])]
    public function show(Categories $category): Response
    {
        return $this->render('profil_category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_profil_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categories $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoriesForm::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profil_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profil_category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profil_category_delete', methods: ['POST'])]
    public function delete(Request $request, Categories $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_profil_category_index', [], Response::HTTP_SEE_OTHER);
    }
}

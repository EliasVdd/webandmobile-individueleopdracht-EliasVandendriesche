<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategoryType;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category", name="category")
     */
    public function addCategory(Request $request)
    {
        $form = $this->createForm(CategoryType::class, new Category());

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $category = new Category();
            $formData = $form->getData();
            $category->setName($formData->getName());

            $this->postCategory($category);

            return $this->redirectToRoute('categories');
        }

        return $this->render('category/addCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function postCategory(Category $category)
    {
        $emManager = $this->getDoctrine()->getManager();

        $emManager->persist($category);
        $emManager->flush();
    }
}

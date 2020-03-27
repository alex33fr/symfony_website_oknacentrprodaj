<?php

namespace App\Controller;

use App\Entity\MainCategory;
use App\Entity\Product;
use App\Repository\MainCategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SubCategoryRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/{title}", name="mainCategory_show", methods={"GET"})
     * @param MainCategory $mainCategory
     * @param MainCategoryRepository $mainCategoryRepository
     * @param SubCategoryRepository $subCategoryRepository
     * @param ProductRepository $productRepository
     * @return Response
     * @throws NonUniqueResultException
     */
    public function mainCategory_show(MainCategory $mainCategory, MainCategoryRepository $mainCategoryRepository, SubCategoryRepository $subCategoryRepository, ProductRepository $productRepository): Response
    {
        $value = $mainCategory->getId();
        $mainCategory = $mainCategoryRepository->findByCategory($value);
        $mainCategoryTitle = $mainCategoryRepository->findTitleByCategory($value);
        return $this->render('front/main_index.html.twig', [
            'main_category' => $mainCategory,
            'main_category_title' => $mainCategoryTitle,
            'controller_name' => 'title',
            'sub_category' => $subCategoryRepository->findBy(['mainCategory' => $value]),
            'product' => $productRepository->findAll()
        ]);
    }

    /**
     * @Route("/okna", name="okna_show", methods={"GET"})
     * @param SubCategoryRepository $subCategoryRepository
     * @return Response
     */

    public function okna_show(SubCategoryRepository $subCategoryRepository): Response
    {
        return $this->render('front/show_sub_category.html.twig', [
            'sub_categories' => $subCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("product/{id}", name="show_product", methods={"GET"})
     * @param Product $product
     * @return Response
     */
    public function show_product(Product $product): Response
    {
        return $this->render('front/show_product.html.twig', [
            'product' => $product,
        ]);
    }

}

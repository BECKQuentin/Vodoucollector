<?php

namespace App\Controller\Objects\Metadata;

use App\Entity\Objects\Metadata\Categories;
use App\Form\Objects\MetaDataFormType;
use App\Repository\Objects\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    const ROUTE         = 'categories';
    const METADATA_NAME = 'Categories';

    /**
     * @Route("/categories", name="categories")
     *
     */
    public function addCategories(CategoriesRepository $categoriesRepository, Request $request): Response
    {
        $metadata = new Categories();
        $metadataRepository = $categoriesRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/categories-edit/{id}", name="categories_edit")
     *
     */
    public function editCategories(Categories $categories, CategoriesRepository $categoriesRepository,Request $request): Response
    {
        $metadata = $categories;
        $metadataRepository = $categoriesRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/categories-delete/{id}", name="categories_delete")
     */
    public function deleteCategories(Categories $categories, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categories);
        $em->flush();

        $this->addFlash('danger', 'Vous avez supprimé '.$categories->getName().' !');
        return $this->redirectToRoute(self::ROUTE);
    }



    //////////////* GLOBAL METADATAS (CRU)*///////////////////
    public function viewReturnMetadata($metadata, $metadataRepository, $request)
    {
        $allMetadata = $metadataRepository->findAll();
        $form = $this->createForm(MetaDataFormType::class, $metadata);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($metadata);
            $em->flush();

            $this->addFlash('success', "L'article a bien été ajoutée");
            return $this->redirectToRoute(self::ROUTE);
        }

        return $this->render('objects/metadata/metadata.html.twig', [
            'editRoute'     => self::ROUTE.'_edit',
            'deleteRoute'   => self::ROUTE.'_delete',
            'className'     => self::METADATA_NAME,
            'items'         => $allMetadata,
            'form'          => $form->createView(),
        ]);
    }
}

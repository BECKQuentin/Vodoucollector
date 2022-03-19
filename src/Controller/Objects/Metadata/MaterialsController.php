<?php

namespace App\Controller\Objects\Metadata;

use App\Entity\Objects\Metadata\Materials;
use App\Form\Objects\MetaDataFormType;
use App\Repository\Objects\MaterialsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialsController extends AbstractController
{
    const ROUTE         = 'materials';
    const METADATA_NAME = 'Matériaux';

    /**
     * @Route("/materials", name="materials")
     *
     */
    public function addMaterials(MaterialsRepository $materialsRepository, Request $request): Response
    {
        $metadata = new Materials();
        $metadataRepository = $materialsRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/materials-edit/{id}", name="materials_edit")
     *
     */
    public function editMaterials(Materials $materials, MaterialsRepository $materialsRepository,Request $request): Response
    {
        $metadata = $materials;
        $metadataRepository = $materialsRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/materials-delete/{id}", name="materials_delete")
     */
    public function deleteMaterials(Materials $materials, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($materials);
        $em->flush();

        $this->addFlash('danger', 'Vous avez supprimé '.$materials->getName().' !');
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

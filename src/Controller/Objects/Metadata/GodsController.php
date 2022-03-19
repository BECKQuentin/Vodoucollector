<?php

namespace App\Controller\Objects\Metadata;

use App\Entity\Objects\Metadata\Gods;
use App\Form\Objects\MetaDataFormType;
use App\Repository\Objects\GodsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GodsController extends AbstractController
{
    const ROUTE         = 'gods';
    const METADATA_NAME = 'Dieux';

    /**
     * @Route("/gods", name="gods")
     *
     */
    public function addGods(GodsRepository $godsRepository, Request $request): Response
    {
        $metadata = new Gods();
        $metadataRepository = $godsRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/gods-edit/{id}", name="gods_edit")
     *
     */
    public function editGods(Gods $gods, GodsRepository $godsRepository,Request $request): Response
    {
        $metadata = $gods;
        $metadataRepository = $godsRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/gods-delete/{id}", name="gods_delete")
     */
    public function deleteGods(Gods $gods, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($gods);
        $em->flush();

        $this->addFlash('danger', 'Vous avez supprimé '.$gods->getName().' !');
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

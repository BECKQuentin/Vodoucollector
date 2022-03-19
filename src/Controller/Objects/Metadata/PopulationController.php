<?php

namespace App\Controller\Objects\Metadata;

use App\Entity\Objects\Metadata\Population;
use App\Form\Objects\MetaDataFormType;
use App\Repository\Objects\PopulationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PopulationController extends AbstractController
{
    const ROUTE         = 'population';
    const METADATA_NAME = 'Population';

    /**
     * @Route("/population", name="population")
     *
     */
    public function addPopulation(PopulationRepository $populationRepository, Request $request): Response
    {
        $metadata = new Population();
        $metadataRepository = $populationRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/population-edit/{id}", name="population_edit")
     *
     */
    public function editPopulation(Population $population, PopulationRepository $populationRepository,Request $request): Response
    {
        $metadata = $population;
        $metadataRepository = $populationRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/population-delete/{id}", name="population_delete")
     */
    public function deletePopulation(Population $population, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($population);
        $em->flush();

        $this->addFlash('danger', 'Vous avez supprimé '.$population->getName().' !');
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

<?php

namespace App\Controller\Objects\Metadata;


use App\Entity\Objects\Metadata\State;
use App\Form\Objects\MetaDataFormType;
use App\Repository\Objects\StateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StateController extends AbstractController
{
    const ROUTE         = 'state';
    const METADATA_NAME = 'Etat';

    /**
     * @Route("/state", name="state")
     *
     */
    public function addState(StateRepository $stateRepository, Request $request): Response
    {
        $metadata = new State();
        $metadataRepository = $stateRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/state-edit/{id}", name="state_edit")
     *
     */
    public function editState(State $state, StateRepository $stateRepository,Request $request): Response
    {
        $metadata = $state;
        $metadataRepository = $stateRepository;

        return $this->viewReturnMetadata($metadata, $metadataRepository, $request);
    }

    /**
     * @Route("/state-delete/{id}", name="state_delete")
     */
    public function deleteState(State $state, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($state);
        $em->flush();

        $this->addFlash('danger', 'Vous avez supprimé '.$state->getName().' !');
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

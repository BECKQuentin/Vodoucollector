<?php

namespace App\Controller\Objects;

use App\Entity\Objects\Librairies;
use App\Form\Objects\LibrairiesFormType;
use App\Repository\Objects\LibrairiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibrairesController extends AbstractController
{
    /**
     * @Route("/librairies", name="librairies")
     */
    public function listingLibrairies(LibrairiesRepository $librairiesRepository): Response
    {
        $librairies = $librairiesRepository->findAll();

        return $this->render('objects/librairies/listing.html.twig', [
            'librairies'     => $librairies,
        ]);
    }

    /**
     * @Route("/librairies-add", name="librairies_add")
     *
     */
    public function addLibrairies(Request $request): Response
    {
        $librairies = new Librairies();
        $form = $this->createForm(LibrairiesFormType::class, $librairies);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($librairies);
            $em->flush();

            $this->addFlash('success', "L'article a bien été ajoutée");
            return $this->redirectToRoute('librairies');
        }

        return $this->render('objects/librairies/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/librairies-edit/{id}", name="librairies_edit")
     *
     */
    public function editLibrairies(Librairies $librairies, Request $request): Response
    {

        $form = $this->createForm(LibrairiesFormType::class, $librairies);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($librairies);
            $em->flush();

            $this->addFlash('success', "Les modifications ont bien été sauvegardées !");
        }

        return $this->render('objects/librairies/edit.html.twig', [
            'librairies'    => $librairies,
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/objects-delete/{id}", name="objects_delete")
     */
    public function deleteLibrairies(Librairies $librairies): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($librairies);
        $em->flush();

        $this->addFlash('danger', 'Vous avez supprimé '.$librairies->getTitle().' !');
        return $this->redirectToRoute('librairies');
    }
}

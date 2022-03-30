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
     * @Route("/librairy-add", name="librairy_add")
     *
     */
    public function addLibrairy(Request $request, LibrairiesRepository $librairiesRepository): Response
    {
        $allLibrairies = $librairiesRepository->findAll();
        $librairies = new Librairies();
        $form = $this->createForm(LibrairiesFormType::class, $librairies);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($librairies);
            $em->flush();

            $this->addFlash('success', "L'article a bien été ajoutée");
            return $this->redirectToRoute('librairy_add');
        }

        return $this->render('objects/librairies/add.html.twig', [
            'form'      => $form->createView(),
            'libraires' => $allLibrairies,
        ]);
    }

    /**
     * @Route("/librairy-edit/{id}", name="edit_librairy")
     *
     */
    public function editLibrairy(Librairies $librairy, LibrairiesRepository $librairiesRepository, Request $request): Response
    {
        $allLibrairies = $librairiesRepository->findAll();
        $form = $this->createForm(LibrairiesFormType::class, $librairy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($librairy);
            $em->flush();

            $this->addFlash('success', "Les modifications ont bien été sauvegardées !");
            return $this->redirectToRoute('librairy_add');
        }

        return $this->render('objects/librairies/add.html.twig', [
            'librairy'    => $librairy,
            'libraires'     => $allLibrairies,
            'form'          => $form->createView(),
        ]);
    }

    /**
     * @Route("/librairy-delete/{id}", name="delete_librairy")
     */
    public function deleteLibrairies(Librairies $librairy): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($librairy);
        $em->flush();

        $this->addFlash('danger', 'Vous avez supprimé '.$librairy->getTitle().' !');
        return $this->redirectToRoute('librairy_add');
    }
}

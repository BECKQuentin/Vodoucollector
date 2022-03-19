<?php

namespace App\Controller\Objects;

use App\Entity\Objects\Objects;
use App\Form\Objects\ObjectsFormType;
use App\Repository\Objects\ObjectsRepository;
use App\Repository\Objects\TagsRepository;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObjectsController extends AbstractController
{
    /**
     * @Route("/objects", name="objects")
     *
     */
    public function listingObjects(ObjectsRepository $objectsRepository,PaginatorInterface $paginator, Request $request): Response
    {
//        if ($tag = $request->query->get('tags')) {
//            $objects = $objectsRepository->findByTag($tag);
//        } else {
            $allObj = $objectsRepository->findAll();
//        }
            $countObjects = $objectsRepository->countObjects();
            $objects = $paginator->paginate(
                $allObj,
                $request->query->getInt('page', 1), //Nb actual page
                8 //Nb result per page
            );
        return $this->render('objects/objects/listing.html.twig', [
            'objects'       => $objects,
            'countObjects'  => $countObjects,
        ]);
    }

    /**
     * @Route("/objects-add", name="objects_add")
     *
     */
    public function addObjects(Request $request): Response
    {
        $objects = new Objects();
        $form = $this->createForm(ObjectsFormType::class, $objects);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//           //verif de l'image
//            $tags = $form->get('tags')->getData();
//
//            foreach ($tags as $tag) {
//                $objects->addTag($tag);
//            }
            //recup categories du formulaire
//            $categories = $form->getData()->getCategories();
//            $objects->setCategories($categories);
//            //recup categories du formulaire
//            $origin = $form->getData()->getOrigin();
//            $objects->setCategories($origin);

            $em = $this->getDoctrine()->getManager();
            $em->persist($objects);
            $em->flush();

            $this->addFlash('success', "L'article a bien été ajoutée");
            return $this->redirectToRoute('objects');
        }

        return $this->render('objects/objects/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/objects-edit/{id}", name="objects_edit")
     *
     */
    public function editObjects(Objects $objects, Request $request): Response
    {

        $form = $this->createForm(ObjectsFormType::class, $objects);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($objects);
            $em->flush();

            $this->addFlash('success', "Les modifications ont bien été sauvegardées !");
        }

        return $this->render('objects/objects/edit.html.twig', [
            'object'    => $objects,
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/objects-delete/{id}", name="objects_delete")
     */
    public function deletObjects(Objects $objects): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($objects);
        $em->flush();

        $this->addFlash('danger', 'Vous avez supprimé '.$objects->getTitle().' !');
        return $this->redirectToRoute('objects');
    }

}

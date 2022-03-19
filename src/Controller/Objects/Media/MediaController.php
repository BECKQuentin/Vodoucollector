<?php

namespace App\Controller\Objects\Media;

use App\Entity\Objects\Images;
use App\Entity\Objects\Objects;
use App\Form\Objects\MediaFormType;
use App\Repository\Objects\ImagesRepository;
use App\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends AbstractController
{

    /**
     * @Route("/objects/{id}/media", name="objects_media")
     *
     */
    public function media(Objects $objects, Request $request, UploadService $uploadService, ImagesRepository $imagesRepository): Response
    {
        $form = $this->createForm(MediaFormType::class, $objects);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('name')->getData();

            if ($images) {
                foreach ($images as $image) {

                    $fileNameCode = $uploadService->createFileName($image, $objects, $imagesRepository);
                    $fileName = $uploadService->uploadImages($image, $objects, $fileNameCode);

                    $img = new Images();
                    $img->setName($fileName);
                    $img->setCode($fileNameCode);
                    $img->setObjects($objects);//
                    $objects->addImage($img);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($objects);
                    $em->flush();
                }
            }
        }

        return $this->render('objects/media/media.html.twig', [
            'object' => $objects,
            'form'   => $form->createView(),
        ]);
    }






}

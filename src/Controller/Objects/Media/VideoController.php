<?php

namespace App\Controller\Objects\Media;

use App\Entity\Objects\Objects;
use App\Entity\Objects\Videos;
use App\Form\Objects\MediaFormType;
use App\Repository\Objects\VideosRepository;
use App\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    /**
     * @Route("/objects/{id}/video", name="objects_videos")
     *
     */
    public function videoIndex(Objects $objects, Request $request, UploadService $uploadService, VideosRepository $videosRepository): Response
    {
        $form = $this->createForm(MediaFormType::class, $objects);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $videos = $form->get('name')->getData();

            if ($videos) {
                foreach ($videos as $video) {

                    if($uploadService->isVideo($video)) {
                        $fileNameCode = $uploadService->createFileName($video, $objects, $videosRepository);
                        $fileName = $uploadService->upload($video, $objects, $fileNameCode);

                        $vid = new Videos();
                        $vid->setName($fileName);
                        $vid->setCode($fileNameCode);
                        $vid->setObjects($objects);
                        $objects->addVideo($vid);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($objects);
                        $em->flush();
                    } else {
                        $this->addFlash('danger', 'Ceci n\'est pas une vidéo valide');
                        $this->redirectToRoute('objects_files');
                    }
                }
            }
        }

        return $this->render('objects/media/video.html.twig', [
            'object'    => $objects,
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/video-delete/{id}/{object}", name="delete_objects_vid")
     *
     */
    public function videoDelete(Videos $videos, Request $request, UploadService $uploadService) {

        $objId = $request->get('object');

        $filesystem = new Filesystem();
        $filesystem->remove($videos->getAbsolutePath());

        $em = $this->getDoctrine()->getManager();
        $em->remove($videos);
        $em->flush();

        return($this->redirectToRoute('objects_videos',
            ['id' => $objId],
        ));

    }





}

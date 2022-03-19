<?php

namespace App\Controller\Objects\Media;

use App\Entity\Objects\Objects;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{

    /**
     * @Route("/objects/{id}/video", name="objects_video")
     *
     */
    public function video(Objects $objects, Request $request): Response
    {



        return $this->render('objects/media/video.html.twig', [
            'object' => $objects
        ]);
    }




}

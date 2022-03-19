<?php

namespace App\Controller\Objects\Media;

use App\Entity\Objects\Objects;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{

    /**
     * @Route("/objects/{id}/file", name="objects_file")
     *
     */
    public function fileIndex(Objects $objects, Request $request): Response
    {


        return $this->render('objects/media/file.html.twig', [
            'object' => $objects
        ]);
    }




}

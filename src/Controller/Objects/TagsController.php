<?php

namespace App\Controller\Objects;

use App\Repository\Objects\TagsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TagsController extends AbstractController
{
    /**
     * @Route("/tags-json", name="tags_json")
     */
    public function index(Request $request, TagsRepository $tagsRepository, SerializerInterface $serializer): Response
    {
        $tags = $tagsRepository->findAll();
        return $this->json($tags, 200, [], ['groups' => 'public']);
    }
}

<?php

namespace App\Service;

use App\Repository\Objects\ImagesRepository;
use App\Repository\Objects\ObjectsRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\AsciiSlugger;

class UploadService
{
    private string $uploadImagesDirectory;
    
    public function __construct(string $uploadImageDirectory)
    {
        $this->uploadImagesDirectory = $uploadImageDirectory;
    }

    public function uploadImages(UploadedFile $images, $entity, $fileNameCode): string
    {

        $fileName = $fileNameCode.'.'.$images->getClientOriginalExtension();

        $path = $this->uploadImagesDirectory . "/";
        $images->move($path, $fileName);

        return $fileName;
    }

    public function createFileName(UploadedFile $images, $entity, $imagesRepository): string
    {
        $arrImages = $imagesRepository->findAllImagesByObject($entity);

        dd($arrImages);

        $fileNameCode = $entity->getCode().'_'.'b';

        return $fileNameCode;
    }

//    private function createFileNameRandom(UploadedFile $file): string
//    {
//        $slugger = new AsciiSlugger();
//        $fileName = $slugger->slug($file->getClientOriginalName())->lower();
//        $fileName = explode('-', $fileName);
//        $fileName = array_slice($fileName, 0, -1);
//        $fileName = join('-', $fileName);
//        $fileName .= '.' . uniqid() . '.' . $file->guessExtension();
//
//        return $fileName;
//    }


}
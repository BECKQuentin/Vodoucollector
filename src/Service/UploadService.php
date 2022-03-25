<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    public function createFileNameImg(UploadedFile $images, $entity, $imagesRepository): string
    {
        $arrImages  = $imagesRepository->findAllImagesByObject($entity);
        $arrCode    = [];
        $arrLetter  = [];
        $alphas = range('a', 'z');

        //extraire code pour toutes les images de l'objet
        foreach ($arrImages as $imgCode) {
            $arrCode[] = $imgCode->getCode();
        }
        //extraie chacune des lettre pour toutes les images de l'objet
        foreach ($arrCode as $code) {
            $arrLetter[] = explode('_', $code)[1];
        }
        //Attribuer lettre du regex si inexistante
        foreach ($alphas as $a) {
            $res = in_array($a, $arrLetter );
            if ($res == false) {
                $fileNameCode = $entity->getCode().'_'.$a;
                return $fileNameCode;
            }
        }
        return $entity->getCode().'_'.'none';
    }

}
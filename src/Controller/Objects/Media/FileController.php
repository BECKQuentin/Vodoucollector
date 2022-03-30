<?php

namespace App\Controller\Objects\Media;

use App\Entity\Objects\Metadata\Files;
use App\Entity\Objects\Objects;
use App\Form\Objects\MediaFormType;
use App\Repository\Objects\FilesRepository;
use App\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{

    /**
     * @Route("/objects/{id}/file", name="objects_files")
     *
     */
    public function fileIndex(Objects $objects, Request $request, UploadService $uploadService, FilesRepository $filesRepository): Response
    {
        $form = $this->createForm(MediaFormType::class, $objects);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $files = $form->get('name')->getData();

            if ($files) {
                foreach ($files as $file) {

                    if($uploadService->isFile($file)) {
                        $fileNameCode = $uploadService->createFileName($file, $objects, $filesRepository);
                        $fileName = $uploadService->upload($file, $objects, $fileNameCode);

                        $fl = new Files();
                        $fl->setName($fileName);
                        $fl->setCode($fileNameCode);
                        $fl->setObjects($objects);
                        $objects->addFile($fl);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($objects);
                        $em->flush();
                    } else {
                        $this->addFlash('danger', 'Ceci n\'est pas un fichier valide');
                        $this->redirectToRoute('objects_files');
                    }
                }
            }
        }

        return $this->render('objects/media/file.html.twig', [
            'object'    => $objects,
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/file-delete/{id}/{object}", name="delete_objects_file")
     *
     */
    public function fileDelete(Files $files, Request $request, UploadService $uploadService) {

        $objId = $request->get('object');

        $filesystem = new Filesystem();
        $filesystem->remove($files->getAbsolutePath());

        $em = $this->getDoctrine()->getManager();
        $em->remove($files);
        $em->flush();

        return($this->redirectToRoute('objects_files',
            ['id' => $objId],
        ));

    }

//    /**
//     * @Route("/file-dl/{id}", name="download_file")
//     */
//    public function downloadAction(Files $file)
//    {
//
//        $response = new Response();
//
//        //set headers
//        $response->headers->set('Content-Type', 'mime/type');
//        $response->headers->set('Content-Disposition', 'attachment;filename="'.$file->getName());
//
//        $response->setContent($file->getAbsolutePath());
//        return $response;
//    }



}

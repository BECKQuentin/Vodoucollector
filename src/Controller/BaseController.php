<?php

namespace App\Controller;

use App\Repository\Objects\ObjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(ObjectsRepository $objectsRepository): Response
    {
        $countObjects = $objectsRepository->countObjects();
        $countIsExposedTempObjects = $objectsRepository->countIsExposedTemp();
        $countIsExposedPermObjects = $objectsRepository->countIsExposedPerm();
        return $this->render('home/home.html.twig', [
            'countObjects' => $countObjects,
            'countIsExposedTempObjects' => $countIsExposedTempObjects,
            'countIsExposedPermObjects' => $countIsExposedPermObjects,
        ]);
    }


    public function header($routeName)
    {
        return $this->render('base/header.html.twig', [
            'route_name' => $routeName,
        ]);
    }

    /**
     * @Route("/redirect-user", name="redirect_user")
     */
    public function redirectUser()
    {

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('home');
        }
        elseif ($this->isGranted('ROLE_MEMBER')) {
            return $this->redirectToRoute('home');
        }
        else {
            return $this->redirectToRoute('login');
        }
    }

}

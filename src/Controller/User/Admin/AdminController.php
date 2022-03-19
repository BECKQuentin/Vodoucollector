<?php

namespace App\Controller\User\Admin;

use App\Entity\User\User;
use App\Form\User\RegistrationFormType;
use App\Repository\User\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/a/member-update/{id}", name="admin_member_update")
     * @IsGranted("ROLE_ADMIN", message="Seuls les Admins peuvent faire ça")
     */
    public function memberUpdateByAdmin(Request $request, UserRepository $userRepository)
    {
        $id = $request->get('id');
        $userToUpdate = $userRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(RegistrationFormType::class, $userToUpdate);
        $form->remove('submit');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($userToUpdate);
            $em->flush();

            $this->addFlash('success', "Les modifications ont bien été sauvegardées !");
            return $this->redirectToRoute('member');
        }

        return $this->render('user/member/update.html.twig', [
            'form' => $form->createView(),
            'user' => $userToUpdate
        ]);
    }
}
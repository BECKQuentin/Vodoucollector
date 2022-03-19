<?php
////
namespace App\Controller\User\Security;
////
////use App\Entity\User\User;
////use App\Form\User\RegistrationFormType;
use App\Entity\User\User;
use App\Form\User\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class RegistrationController extends AbstractController
{
     /**
     * @Route("/member-add", name="member_add")
     *
     */
    public function registration(UserPasswordHasherInterface $passwordHasher, Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->remove('status')->remove('modify');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // get password entry
            $plaintextPassword = $form->getData()->getPassword();
            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $user->setRoles(['ROLE_MEMBER']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', "Utilisateur ajouté!");
            return $this->redirectToRoute('member', ['id' => $user->getId()]);
        }
        return $this->render('user/member/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
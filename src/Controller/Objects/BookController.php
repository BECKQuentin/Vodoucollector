<?php

namespace App\Controller\Objects;

use App\Entity\Objects\Book;
use App\Entity\Objects\Librairies;
use App\Form\Objects\BookFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
     /**
     * @Route("/book-add", name="book_add")
     *
     */
    public function addBook(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookFormType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $librairies = $form->getData()->getLibrairies();
            foreach ($librairies as $librairy) {
                $book->addLibrairies($librairy);
                $librairy->addBook($book);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            $this->addFlash('success', "L'article a bien été ajoutée");
            return $this->redirectToRoute('librairies');
        }

        return $this->render('objects/book/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/book-edit/{id}", name="edit_book")
     *
     */
    public function editBook(Book $book, Request $request): Response
    {
        $form = $this->createForm(BookFormType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            $this->addFlash('success', "Les modifications ont bien été sauvegardées !");
        }

        return $this->render('objects/book/add.html.twig', [
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("libairies/{librairy}/book-delete/{id}/", name="delete_book")
     */
    public function deleteBook(Book $book, Librairies $librairy): Response
    {
        $librairy->removeBook($book);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('danger', 'Vous avez supprimé '.$book->getTitle().' !');
        return $this->redirectToRoute('librairies');
    }
}

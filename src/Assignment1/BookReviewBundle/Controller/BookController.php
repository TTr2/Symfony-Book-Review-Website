<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 08/01/2018
 * Time: 19:05
 */

namespace Assignment1\BookReviewBundle\Controller;

use Assignment1\BookReviewBundle\Entity\Book;
use Assignment1\BookReviewBundle\Entity\Author;
use Assignment1\BookReviewBundle\Form\BookType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookController extends Controller
{
    public function newAction(Request $request, $authorId)
    {
        // Retrieve the author instance
        $em = $this->getDoctrine()->getManager();
        $author = $em->getRepository('BookReviewBundle:Author')->find($authorId);

        $book = new Book();
        $form = $this->createForm(BookType::class, $book, array('authorId' => $authorId));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // persist the new $book variable
            $em->persist($book);
            $em->flush();

            return $this->redirect($this->generateUrl('book_review_view_book', array('bookId' => $book->getId())));
        }

        return $this->render('BookReviewBundle:Page:newBook.html.twig', array(
            'form' => $form->createView(), 'author' => $author
        ));
    }

    public function viewAction($bookId)
    {
        // Retrieve the book instance
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('BookReviewBundle:Book')->find($bookId);

        if (!$book)
        {
            throw $this->createNotFoundException('Sorry, that book was not found.');
        }

        return $this->render('BookReviewBundle:Page:viewBook.html.twig', ['bookId' => $book->getId()]);
    }

    public function editAction(Request $request, $bookId)
    {
        // Retrieve the book instance
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('BookReviewBundle:Book')->find($bookId);
        if (!$book)
        {
            throw $this->createNotFoundException('Sorry, that book was not found.');
        }
        $form = $this->createForm(BookType::class, $book );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // persist the new $book variable
            $em->persist($book);
            $em->flush();

            return $this->redirect($this->generateUrl('book_review_view_book', array('bookId' => $book->getId())));
        }

        return $this->render('BookReviewBundle:Page:newBook.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
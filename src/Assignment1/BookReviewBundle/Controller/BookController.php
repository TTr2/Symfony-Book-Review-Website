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
use Assignment1\BookReviewBundle\Entity\Review;
use Assignment1\BookReviewBundle\Form\BookType;
use Assignment1\BookReviewBundle\Form\ReviewType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookController extends Controller
{
    /**
     * @param Request $request
     * @param $authorId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param Request $request
     * @param $bookId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, $bookId)
    {
        // Retrieve the book instance
        $er = $this->getDoctrine()->getManager()->getRepository('BookReviewBundle:Book');
        $book = $er->find($bookId);

        if (!$book)
        {
            throw $this->createNotFoundException('Sorry, that book was not found.');
        }

        $avgRating = $er->queryAverageBookReviewRating($bookId);
        $numReviews = $er->queryCountBookReviews($bookId);

        $user = $this->getUser();
        if ($user)
        {
            $review = new Review();
            $form = $this->createForm(ReviewType::class, $review, array('bookId' => $book->getId(), 'userId' => $user->getId()) );
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                // persist the new $book variable
                $em = $this->getDoctrine()->getManager();
                $em->persist($review);
                $em->flush();

                return $this->redirect($this->generateUrl('book_review_view_review', array('reviewId' => $review->getId())));
            }

            return $this->render('BookReviewBundle:Page:viewBook.html.twig',
                array('form' => $form->createView(), 'book' => $book, 'avgRating' => $avgRating, 'numReviews' => $numReviews));
        }

        return $this->render('BookReviewBundle:Page:viewBook.html.twig',
            array('book' => $book, 'user' => $user, 'avgRating' => $avgRating, 'numReviews' => $numReviews));
    }

    /**
     * @param Request $request
     * @param $bookId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirect($this->generateUrl('book_review_view_book', array('bookId' => $book->getId())));
        }

        return $this->render('BookReviewBundle:Page:editBook.html.twig', array(
            'form' => $form->createView(), 'book' => $book,
        ));
    }
}
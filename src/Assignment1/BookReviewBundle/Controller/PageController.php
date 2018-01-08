<?php

namespace Assignment1\BookReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('BookReviewBundle:Page:index.html.twig', array(
        ));
    }

    public function aboutAction()
    {
        return $this->render('BookReviewBundle:Page:about.html.twig', array(
        ));
    }

    public function userAction($userId)
    {
        return $this->render('BookReviewBundle:Page:user.html.twig', array(
            'userId' => $userId
        ));
    }

    public function bookAction($bookId)
    {
        return $this->render('BookReviewBundle:Page:book.html.twig', array(
            'bookId' => $bookId
        ));
    }

    public function reviewAction($reviewId)
    {
        return $this->render('BookReviewBundle:Page:review.html.twig', array(
            'reviewId' => $reviewId
        ));
    }

    public function addAuthorAction()
    {
        return $this->render('BookReviewBundle:Page:addAuthor.html.twig', array(
        ));
    }

    public function addBookAction()
    {
        return $this->render('BookReviewBundle:Page:addBook.html.twig', array(
        ));
    }
}

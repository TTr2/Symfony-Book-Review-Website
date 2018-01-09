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
        return $this->render('viewUser.twig', array(
            'userId' => $userId
        ));
    }

    public function reviewAction($reviewId)
    {
        return $this->render('viewReview.html.twig', array(
            'reviewId' => $reviewId
        ));
    }

}

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
        return $this->render('BookReviewBundle:Page:viewUser.twig', array(
            'userId' => $userId
        ));
    }
}

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
use Assignment1\BookReviewBundle\Entity\Comment;
use Assignment1\BookReviewBundle\Entity\Review;
use Assignment1\BookReviewBundle\Form\BookType;
use Assignment1\BookReviewBundle\Form\CommentType;
use Assignment1\BookReviewBundle\Form\ReviewType;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReviewController extends Controller
{
    /**
     * @param Request $request
     * @param $reviewId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, $reviewId)
    {
        // Retrieve the review instance
        $er = $this->getDoctrine()->getManager()->getRepository('BookReviewBundle:Review');
        $review = $er->find($reviewId);

        if (!$review)
        {
            throw $this->createNotFoundException('Sorry, that review was not found.');
        }

        $user = $this->getUser();
        if ($user)
        {
            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                // persist the new $comment variable
                $em = $this->getDoctrine()->getManager();
                $comment->setUser($user);
                $comment->setReview($review);
                $em->persist($comment);
                $em->flush();

                return $this->redirect($this->generateUrl('book_review_view_review', array('reviewId' => $review->getId())));
            }

            return $this->render('BookReviewBundle:Page:viewReview.html.twig',
                array('form' => $form->createView(), 'review' => $review, 'user' => $user));
        }

        return $this->render('BookReviewBundle:Page:viewReview.html.twig', array('review' => $review, 'user' => $user));
    }

    /**
     * @param Request $request
     * @param $reviewId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $reviewId)
    {
        // Retrieve the review instance
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository('BookReviewBundle:Review')->find($reviewId);
        if (!$review)
        {
            throw $this->createNotFoundException('Sorry, that review was not found.');
        }
        $user = $this->getUser();
        if ($user->getId() != $review->getUser()->getId())
        {
            throw $this->createAccessDeniedException("Sorry, you don't have permission to edit other people's reviews.");
        }

        $form = $this->createForm(ReviewType::class, $review,
            array('bookId' => $review->getBook()->getId(), 'userId' => $user->getId()) );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // persist the edited $review variable
            $em = $this->getDoctrine()->getManager();
//            $review->set
            $em->flush();

            return $this->redirect($this->generateUrl('book_review_view_review',
                array('reviewId' => $review->getId(), 'user' => $user)));
        }

        return $this->render('BookReviewBundle:Page:editReview.html.twig',
            array('form' => $form->createView(), 'review' => $review, 'user' => $user));
    }

    /**
     * @param UserInterface $user
     * @param $commentId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCommentAction(UserInterface $user,  $commentId)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('BookReviewBundle:Comment')->find($commentId);
        $reviewId = $comment->getReview()->getId();
        if ($user == $comment->getUser())
        {
            $em->remove($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('book_review_view_review',
                array('reviewId' => $reviewId, 'user' => $user)));
        }
        else
        {
            throw $this->createAccessDeniedException('Sorry, you can only delete your own comments.');
        }
    }
}
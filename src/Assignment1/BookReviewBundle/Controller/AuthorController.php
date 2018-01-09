<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 22/12/2017
 * Time: 11:46
 */

namespace Assignment1\BookReviewBundle\Controller;


use Assignment1\BookReviewBundle\Entity\Author;
use Assignment1\BookReviewBundle\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends Controller
{

    public function viewAction($authorId)
    {
        // Retrieve the author instance
        $em = $this->getDoctrine()->getManager();
        $author = $em->getRepository('BookReviewBundle:Author')->find($authorId);

        return $this->render('BookReviewBundle:Page:viewAuthor.html.twig', ['author' => $author]);
    }

    public function editAction(Request $request, $authorId)
    {
        // Retrieve the author instance
        $em = $this->getDoctrine()->getManager();
        $author = $em->getRepository('BookReviewBundle:Author')->find($authorId);

        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Persist the new $author variable
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            return $this->redirect($this->generateUrl('book_review_view_author', array('authorId' => $authorId)));

        }

        return $this->render('BookReviewBundle:Page:editAuthor.html.twig', array(
            'form' => $form->createView(), 'author' => $author
        ));
    }

    public function newAction(Request $request)
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // persist the new $author variable
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            return $this->redirect($this->generateUrl('book_review_view_author', array('authorId' => $author->getId())));
        }

        return $this->render('BookReviewBundle:Page:viewAuthor.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
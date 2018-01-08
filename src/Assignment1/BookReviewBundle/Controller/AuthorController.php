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
        return $this->render('BookReviewBundle:Page:author.html.twig', array(
            'authorId' => $authorId
        ));
    }

    /**
    //     * @Route("/author/new", name="author_new")
     */
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

            return $this->redirect($this->generateUrl('book_review_author', array('authorId' => $author->getId())));
        }

        return $this->render('BookReviewBundle:Page:addAuthor.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
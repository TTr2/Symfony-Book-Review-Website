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

class SearchController extends Controller
{
    public function viewAction(Request $request)
    {
        $input = $request->request->get('search');

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
//        return $this->render('BookReviewBundle:Page:search.html.twig', ['input' => $input]);
        return $this->render('BookReviewBundle:Page:newAuthor.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
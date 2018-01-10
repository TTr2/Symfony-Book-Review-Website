<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 09/01/2018
 * Time: 21:06
 */

namespace Assignment1\BookReviewBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{

    public function deleteAction($entity, $id)
    {
        $found = false;
        $em = $this->getDoctrine()->getManager();
        switch ($entity)
        {
            case "author":
                $author = $em->getReference('BookReviewBundle:Author', $id);
                $found = $author != false;
                $em->remove($author);
                $em->flush();
                break;
            case "book":
                $book = $em->getReference('BookReviewBundle:Book', $id);
                $found = $book != false;
                $em->remove($book);
                $em->flush();
                break;
            case "review":
                $review = $em->getReference('BookReviewBundle:Review', $id);
                $found = $review != false;
                $em->remove($review);
                $em->flush();
                break;
            case "comment":
                $comment = $em->getReference('BookReviewBundle:Comment', $id);
                $found = $comment != false;
                $em->remove($comment);
                $em->flush();
                break;
            default:
                break;
        }

        $str = $found ? 'true' : 'false';
        return new Response('<html><body>'.$entity.' '.$id.' found = '.$str.'</body></html>');
    }
}
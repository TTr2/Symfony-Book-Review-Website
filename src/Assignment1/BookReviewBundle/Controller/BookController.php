<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 08/01/2018
 * Time: 19:05
 */

namespace Assignment1\BookReviewBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

class BookController
{
    public function newAction(Request $request, $authorId)
    {
        // Retrieve author id form url and embed in form?
        // Or cop out and let user select/add author
    }

    public function viewAction()
    {
    }

    public function editAction()
    {
    }}
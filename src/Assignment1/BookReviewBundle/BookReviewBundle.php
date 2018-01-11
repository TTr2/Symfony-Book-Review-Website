<?php

namespace Assignment1\BookReviewBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BookReviewBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

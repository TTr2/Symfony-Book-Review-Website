<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 21/12/2017
 * Time: 12:27
 */

namespace Assignment1\BookReviewBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u FROM BookReviewBundle:User u ORDER BY u.name ASC'
            )
            ->getResult();
    }
}
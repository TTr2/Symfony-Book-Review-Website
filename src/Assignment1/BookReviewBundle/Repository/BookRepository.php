<?php

namespace Assignment1\BookReviewBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BookRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookRepository extends EntityRepository
{
    /**
     * Query to aggregate review ratings for a book
     * @param $bookId
     */
    public function queryAverageBookReviewRating($bookId)
    {
        $erReview = $this->getEntityManager()->getRepository('BookReviewBundle:Review');
        $query = $erReview->createQueryBuilder('r')
            ->select('avg(r.rating)')
            ->where('r.book = :bookId')
            ->setParameter(":bookId", $bookId)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Query to count number of review ratings for a book
     * @param $bookId
     */
    public function queryCountBookReviews($bookId)
    {
        $er = $this->getEntityManager()->getRepository('BookReviewBundle:Review');
        $query = $er->createQueryBuilder('r')
            ->select('count(r.id)')
            ->where('r.book = :bookId')
            ->setParameter(":bookId", $bookId)
            ->getQuery();

        return $query->getSingleScalarResult();
    }
}

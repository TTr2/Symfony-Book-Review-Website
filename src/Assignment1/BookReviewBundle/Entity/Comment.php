<?php

namespace Assignment1\BookReviewBundle\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="Assignment1\BookReviewBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Assignment1\BookReviewBundle\Entity\Review
     * @ORM\ManyToOne(targetEntity="Review", inversedBy="comments")
     * @ORM\JoinColumn(name="review_id", referencedColumnName="id")
     */
    private $review;

    /**
     * @var \Assignment1\BookReviewBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(name="date", type="datetime_immutable")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="commentBody", type="text")
     */
    private $commentBody;

    /**
     * @var bool
     *
     * @ORM\Column(name="reported", type="boolean", nullable=true)
     */
    private $reported = false;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param DateTimeImmutable $date
     *
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return datetime_immutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set commentBody
     *
     * @param string $commentBody
     *
     * @return Comment
     */
    public function setCommentBody($commentBody)
    {
        $this->commentBody = $commentBody;

        return $this;
    }

    /**
     * Get commentBody
     *
     * @return string
     */
    public function getCommentBody()
    {
        return $this->commentBody;
    }

    /**
     * Set reported
     *
     * @param boolean $reported
     *
     * @return Comment
     */
    public function setReported($reported)
    {
        $this->reported = $reported;

        return $this;
    }

    /**
     * Get reported
     *
     * @return bool
     */
    public function getReported()
    {
        return $this->reported;
    }

    /**
     * Set review
     *
     * @param \Assignment1\BookReviewBundle\Entity\Review $review
     *
     * @return Comment
     */
    public function setReview(\Assignment1\BookReviewBundle\Entity\Review $review = null)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return \Assignment1\BookReviewBundle\Entity\Review
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set user
     *
     * @param \Assignment1\BookReviewBundle\Entity\User $user
     *
     * @return Comment
     */
    public function setUser(\Assignment1\BookReviewBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Assignment1\BookReviewBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

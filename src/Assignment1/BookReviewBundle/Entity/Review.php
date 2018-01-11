<?php

namespace Assignment1\BookReviewBundle\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Review
 *
 * @ORM\Table(name="review")
 * @ORM\Entity(repositoryClass="Assignment1\BookReviewBundle\Repository\ReviewRepository")
 */
class Review
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
     * @var \Assignment1\BookReviewBundle\Entity\Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     */
    private $book;

    /**
     * @var \Assignment1\BookReviewBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reviews")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="review")
     */
    protected $comments;

    /**
     * @var int
     *
     * @Assert\Range(min=0, max=5, minMessage = "Must be 0 stars or more", maxMessage = "Must be 5 stars or less.")
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;


    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(name="datetime", type="datetime_immutable")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="string", length=255)
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="messageBody", type="text")
     */
    private $messageBody;

    /**
     * @var bool
     *
     * @ORM\Column(name="reported", type="boolean", nullable=true)
     */
    private $reported = false;

    /**
     * Review constructor.
     */
    public function __construct()
    {
        $this->date = DateTimeImmutable::createFromMutable(new DateTime());
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set rating
     *
     * @param integer $rating
     *
     * @return Review
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set date
     *
     * @param DateTimeImmutable $date
     *
     * @return Review
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set messageBody
     *
     * @param string $messageBody
     *
     * @return Review
     */
    public function setMessageBody($messageBody)
    {
        $this->messageBody = $messageBody;

        return $this;
    }

    /**
     * Get messageBody
     *
     * @return string
     */
    public function getMessageBody()
    {
        return $this->messageBody;
    }

    /**
     * Set reported
     *
     * @param boolean $reported
     *
     * @return Review
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
     * Set book
     *
     * @param \Assignment1\BookReviewBundle\Entity\Book $book
     *
     * @return Review
     */
    public function setBook(\Assignment1\BookReviewBundle\Entity\User $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \Assignment1\BookReviewBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set user
     *
     * @param \Assignment1\BookReviewBundle\Entity\User $user
     *
     * @return Review
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

    /**
     * Add comment
     *
     * @param \Assignment1\BookReviewBundle\Entity\Comment $comment
     *
     * @return Review
     */
    public function addComment(\Assignment1\BookReviewBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Assignment1\BookReviewBundle\Entity\Comment $comment
     */
    public function removeComment(\Assignment1\BookReviewBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return Review
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }
}

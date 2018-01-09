<?php

namespace Assignment1\BookReviewBundle\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="Assignment1\BookReviewBundle\Repository\BookRepository")
 */
class Book
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToOne(targetEntity="Author")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text", length=255)
     */
    private $synopsis;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Review", mappedBy="book")
     */
    private $reviews;

    /**
     * @var int
     *
     * @ORM\Column(name="num_pages", type="integer", nullable=true)
     */
    private $pages;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn_13", type="string", length=25, unique=true)
     */
    private $isbn_13;

    /**
     * @var \Assignment1\BookReviewBundle\Entity\Genre
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumn(name="genre_id", referencedColumnName="id", nullable=true)
     */
    private $genre;

    /**
     * @var \Assignment1\BookReviewBundle\Entity\Language
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id", nullable=true)
     */
    private $language;

    /**
     * @var \Assignment1\BookReviewBundle\Entity\Publisher
     * @ORM\ManyToOne(targetEntity="Publisher")
     * @ORM\JoinColumn(name="publisher_id", referencedColumnName="id", nullable=true)
     */
    private $publisher;

    /**
     * @var string
     *
     * @ORM\Column(name="amazonURL", type="string", length=768, nullable=true, unique=true)
     */
    private $amazonURL = 'www.amazon.co.uk';

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(name="publishedDate", type="date_immutable", nullable=true)
     */
    private $publishedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="coverImage", type="string", length=255, nullable=true)
     */
    private $coverImage = '/Resources/public/assets/user_images/no_cover_available.png';

    /**
     * Book constructor.
     */
    public function __construct()
    {
        $this->author = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
        if (is_null($this->pages))
        {
            $this->setPages(rand(75,1250));
        }
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
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param string $synopsis
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
    }

    /**
     * Set pages
     *
     * @param integer $pages
     *
     * @return Book
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return int
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set isbn_13
     *
     * @param string $isbn_13
     *
     * @return Book
     */
    public function setIsbn_13($isbn_13)
    {
        $this->isbn_13 = $isbn_13;

        return $this;
    }

    /**
     * Get isbn_13
     *
     * @return string
     */
    public function getIsbn_13()
    {
        return $this->isbn_13;
    }

    /**
     * Set language
     *
     * @param string $language
     *
     * @return Book
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set amazonURL
     *
     * @param string $amazonURL
     *
     * @return Book
     */
    public function setAmazonURL($amazonURL)
    {
        $this->amazonURL = $amazonURL;

        return $this;
    }

    /**
     * Get amazonURL
     *
     * @return string
     */
    public function getAmazonURL()
    {
        return $this->amazonURL;
    }

    /**
     * Set publishedDate
     *
     * @param date_immutable $publishedDate
     *
     * @return Book
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;

        return $this;
    }

    /**
     * Get publishedDate
     *
     * @return date_immutable
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * Set coverImage
     *
     * @param string $coverImage
     *
     * @return Book
     */
    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * Get coverImage
     *
     * @return string
     */
    public function getCoverImage()
    {
        return $this->coverImage;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set isbn13
     *
     * @param string $isbn13
     *
     * @return Book
     */
    public function setIsbn13($isbn13)
    {
        $this->isbn_13 = $isbn13;

        return $this;
    }

    /**
     * Get isbn13
     *
     * @return string
     */
    public function getIsbn13()
    {
        return $this->isbn_13;
    }

    /**
     * Add author
     *
     * @param \Assignment1\BookReviewBundle\Entity\Author $author
     *
     * @return Book
     */
    public function addAuthor(\Assignment1\BookReviewBundle\Entity\Author $author)
    {
        $this->author[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \Assignment1\BookReviewBundle\Entity\Author $author
     */
    public function removeAuthor(\Assignment1\BookReviewBundle\Entity\Author $author)
    {
        $this->author->removeElement($author);
    }

    /**
     * Add review
     *
     * @param \Assignment1\BookReviewBundle\Entity\Review $review
     *
     * @return Book
     */
    public function addReview(\Assignment1\BookReviewBundle\Entity\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \Assignment1\BookReviewBundle\Entity\Review $review
     */
    public function removeReview(\Assignment1\BookReviewBundle\Entity\Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Set genre
     *
     * @param \Assignment1\BookReviewBundle\Entity\Genre $genre
     *
     * @return Book
     */
    public function setGenre(\Assignment1\BookReviewBundle\Entity\Genre $genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Set publisher
     *
     * @param \Assignment1\BookReviewBundle\Entity\Publisher $publisher
     *
     * @return Book
     */
    public function setPublisher(\Assignment1\BookReviewBundle\Entity\Publisher $publisher = null)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return \Assignment1\BookReviewBundle\Entity\Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }
}

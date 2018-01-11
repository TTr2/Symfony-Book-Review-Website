<?php

namespace Assignment1\BookReviewBundle\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @Vich\Uploadable
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
     * @var \Assignment1\BookReviewBundle\Entity\Author
     * @ORM\ManyToOne(targetEntity="Author")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text", nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=25, unique=false)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=60, unique=false)
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
     * @Vich\UploadableField(mapping="book_images", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(name="imageName", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName = 'no_cover_available.png';

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Book constructor.
     */
    public function __construct()
    {
        $this->reviews = new ArrayCollection();
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
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Author $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
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
     * @param DateTime $publishedDate
     *
     * @return Book
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = DateTimeImmutable::createFromMutable($publishedDate);

        return $this;
    }

    /**
     * Get publishedDate
     *
     * @return DateTimeImmutable
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Book
     */
    public function setImageFile(?File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Book
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageFilePath()
    {
        return 'bundles/BookReviewBundle/assets/book_covers/' . $this->imageName;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     *
     * @return Book
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param string $publisher
     *
     * @return Book
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
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
     * Add review
     *
     * @param \Assignment1\BookReviewBundle\Entity\Review $review
     *
     * @return Book
     */
    public function addReview(Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \Assignment1\BookReviewBundle\Entity\Review $review
     */
    public function removeReview(Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Book
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Book
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }
}

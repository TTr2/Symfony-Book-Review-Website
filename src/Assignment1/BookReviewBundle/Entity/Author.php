<?php

namespace Assignment1\BookReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="Assignment1\BookReviewBundle\Repository\AuthorRepository")
 */
class Author
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
     * @ORM\Column(name="firstName", type="string", length=50)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=100)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=150)
     */
    private $fullName;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Book", inversedBy="books")
     * @ORM\JoinTable(name="authors_books")
     */
    private $books;

    /**
     * @var string
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     */
    private $biography = 'No biography available';

    /**
     * @var string
     *
     * @ORM\Column(name="authorImage", type="string", length=255, nullable=true)
     */
    private $authorImage = '/Resources/public/assets/author_images/blank_author_image.png';

    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fullName = $this->firstName . ' ' . $this->lastName;
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
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Author
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Author
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set biography
     *
     * @param string $biography
     *
     * @return Author
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set authorImage
     *
     * @param string $authorImage
     *
     * @return Author
     */
    public function setAuthorImage($authorImage)
    {
        $this->authorImage = $authorImage;

        return $this;
    }

    /**
     * Get authorImage
     *
     * @return string
     */
    public function getAuthorImage()
    {
        return $this->authorImage;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Author
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Add book
     *
     * @param \Assignment1\BookReviewBundle\Entity\Book $book
     *
     * @return Author
     */
    public function addBook(\Assignment1\BookReviewBundle\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \Assignment1\BookReviewBundle\Entity\Book $book
     */
    public function removeBook(\Assignment1\BookReviewBundle\Entity\Book $book)
    {
        $this->books->removeElement($book);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }
}

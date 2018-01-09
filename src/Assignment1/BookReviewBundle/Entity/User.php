<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 20/12/2017
 * Time: 17:08
 */

namespace Assignment1\BookReviewBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Assignment1\BookReviewBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    const USER_IMAGES_PATH = '/web/bundles/BookReviewBundle/assets/user_images/';
    const STOCK_AVATAR_FILENAME = 'stockAvatar';
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Book")
     * @ORM\JoinTable(name="currently_reading_books",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")}
     *     )
     */
    protected $currentlyReading;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Book")
     * @ORM\JoinTable(name="have_read_books",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")}
     *     )
     */
    protected $haveRead;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Book")
     * @ORM\JoinTable(name="want_to_read_books",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")}
     *     )
     */
    protected $wantToRead;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Review", mappedBy="user")
     */
    protected $reviews;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="review")
     */
    protected $comments;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 1024,
     *     minHeight = 200,
     *     maxHeight = 1024
     * )
     */
    protected $avatar;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->currentlyReading = new \Doctrine\Common\Collections\ArrayCollection();
        $this->haveReadList = new \Doctrine\Common\Collections\ArrayCollection();
        $this->wantToRead = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        if ($this->avatar === null)
        {
            $num = rand(1,8);
            $filename = self::USER_IMAGES_PATH . self::STOCK_AVATAR_FILENAME . $num . '.png';
            $this->setAvatar($filename);
        }
    }

    /**
     * @param $filename String
     */
    public function setAvatar($filename)
    {
        $this->avatar = $filename;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCurrentlyReading()
    {
        return $this->currentlyReading;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getHaveReadList()
    {
        return $this->haveRead;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getWantToRead()
    {
        return $this->wantToRead;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add currentlyReading
     *
     * @param \Assignment1\BookReviewBundle\Entity\Book $currentlyReading
     *
     * @return User
     */
    public function addCurrentlyReading(\Assignment1\BookReviewBundle\Entity\Book $currentlyReading)
    {
        $this->currentlyReading[] = $currentlyReading;

        return $this;
    }

    /**
     * Remove currentlyReading
     *
     * @param \Assignment1\BookReviewBundle\Entity\Book $currentlyReading
     */
    public function removeCurrentlyReading(\Assignment1\BookReviewBundle\Entity\Book $currentlyReading)
    {
        $this->currentlyReading->removeElement($currentlyReading);
    }

    /**
     * Add haveRead
     *
     * @param \Assignment1\BookReviewBundle\Entity\Book $haveRead
     *
     * @return User
     */
    public function addHaveRead(\Assignment1\BookReviewBundle\Entity\Book $haveRead)
    {
        $this->haveRead[] = $haveRead;

        return $this;
    }

    /**
     * Remove haveRead
     *
     * @param \Assignment1\BookReviewBundle\Entity\Book $haveRead
     */
    public function removeHaveRead(\Assignment1\BookReviewBundle\Entity\Book $haveRead)
    {
        $this->haveRead->removeElement($haveRead);
    }

    /**
     * Get haveRead
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHaveRead()
    {
        return $this->haveRead;
    }

    /**
     * Add wantToRead
     *
     * @param \Assignment1\BookReviewBundle\Entity\Book $wantToRead
     *
     * @return User
     */
    public function addWantToRead(\Assignment1\BookReviewBundle\Entity\Book $wantToRead)
    {
        $this->wantToRead[] = $wantToRead;

        return $this;
    }

    /**
     * Remove wantToRead
     *
     * @param \Assignment1\BookReviewBundle\Entity\Book $wantToRead
     */
    public function removeWantToRead(\Assignment1\BookReviewBundle\Entity\Book $wantToRead)
    {
        $this->wantToRead->removeElement($wantToRead);
    }

    /**
     * Add review
     *
     * @param \Assignment1\BookReviewBundle\Entity\Review $review
     *
     * @return User
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
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Add comment
     *
     * @param \Assignment1\BookReviewBundle\Entity\Comment $comment
     *
     * @return User
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
}

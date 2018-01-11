<?php
/**
 * Created by PhpStorm.
 * User: tango
 * Date: 20/12/2017
 * Time: 17:08
 */

namespace Assignment1\BookReviewBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * User
 *
 * @Vich\Uploadable
 *
 * @ORM\Entity(repositoryClass="Assignment1\BookReviewBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
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
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    protected $comments;

    /**
     * @Vich\UploadableField(mapping="user_images", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(name="imageName", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->currentlyReading = new ArrayCollection();
        $this->haveReadList = new ArrayCollection();
        $this->wantToRead = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->comments = new ArrayCollection();
        if ($this->imageName === null)
        {
            $num = rand(1,8);
            $filename = 'bundles/BookReviewBundle/assets/user_images/stockAvatar' . $num . '.png';
            $this->setImageName($filename);
        }
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
     * @return User
     */
    public function setImageFile(?File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
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
     * @return User
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

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
     * @return string
     */
    public function getImageFilePath()
    {
        return 'bundles/BookReviewBundle/assets/user_images/' . $this->imageName;
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

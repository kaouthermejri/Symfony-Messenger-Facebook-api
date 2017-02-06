<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 1/5/2017
 * Time: 10:57 AM
 */

namespace AppBundle\Entity;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class FosUser extends BaseUser implements UserInterface, ParticipantInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $facebook_id;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @ORM\Version
     * @var \DateTime
     */
    protected $created = null;

    /**
     * @ORM\Column(type="string", name="category", length=120, nullable=true)
     */
    public $category;

    /**
     * @ORM\Column(type="string",length=64, nullable=true)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", name="image", length=255, nullable=true)
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 1200,
     *     minHeight = 400,
     *     maxHeight = 1200,
     *     mimeTypes={"image/bmp", "image/png", "gif", "jpeg", "jpg"}
     * )
     */
    private $image;

    /**
     * @ORM\Column(type="string",length=64, nullable=true)
     */
    private $temporaryImage;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DatabaseCanTeach", mappedBy="user_id")
     */
    public $can_teach;


    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    public function __construct()
    {
        parent::__construct();
        return $this->can_teach = new ArrayCollection();
    }

    /**
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     *
     * @return FosUser
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return FosUser
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return FosUser
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return FosUser
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return FosUser
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return FosUser
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phone_number = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Add canTeach
     *
     * @param \AppBundle\Entity\DatabaseCanTeach $canTeach
     *
     * @return FosUser
     */
    public function addCanTeach(\AppBundle\Entity\DatabaseCanTeach $canTeach)
    {
        $this->can_teach[] = $canTeach;

        return $this;
    }

    /**
     * Remove canTeach
     *
     * @param \AppBundle\Entity\DatabaseCanTeach $canTeach
     */
    public function removeCanTeach(\AppBundle\Entity\DatabaseCanTeach $canTeach)
    {
        $this->can_teach->removeElement($canTeach);
    }

    /**
     * Get canTeach
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCanTeach()
    {
        return $this->can_teach;
    }

    /**
     * Set temporaryImage
     *
     * @param string $temporaryImage
     *
     * @return FosUser
     */
    public function setTemporaryImage($temporaryImage)
    {
        $this->temporaryImage = $temporaryImage;

        return $this;
    }

    /**
     * Get temporaryImage
     *
     * @return string
     */
    public function getTemporaryImage()
    {
        return $this->temporaryImage;
    }
}

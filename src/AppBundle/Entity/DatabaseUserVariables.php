<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/9/2016
 * Time: 2:18 PM
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class DatabaseUserVariables implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=64)
     */
    private $name_surname;

    /**
     * @ORM\Column(type="string",length=64)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string",length=64, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string",length=120)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @ORM\Version
     * @var \DateTime
     */
    private $created = null;

    /**
     * @var array
     */
    private $roles = array('ROLE_USER');

    /**
     * @ORM\Column(type="string", name="category", length=120, nullable=true)
     */
    public $category;

    /**
     * @ORM\Column(type="string", name="image", length=255)
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 400,
     *     minHeight = 200,
     *     maxHeight = 400
     * )
     */
    private $image;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DatabaseCanTeach", mappedBy="user_id")
     */
    public $can_teach;

    public function __construct()
    {
        return $this->can_teach = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameSurname
     *
     * @param string $namesurname
     *
     * @return DatabaseUserVariables
     */
    public function setNameSurname($namesurname)
    {
        $this->name_surname = $namesurname;

        return $this;
    }

    /**
     * Get nameSurname
     *
     * @return string
     */
    public function getNameSurname()
    {
        return $this->name_surname;
    }

    /**
     * Get Username
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return DatabaseUserVariables
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
     * Set email
     *
     * @param string $email
     *
     * @return DatabaseUserVariables
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return DatabaseUserVariables
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    public function getPlainPassword(){
        return $this->password;
    }
    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
        // blank for now
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return DatabaseUserVariables
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
     * Add canTeach
     *
     * @param \AppBundle\Entity\DatabaseCanTeach $canTeach
     *
     * @return DatabaseUserVariables
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
     * Set image
     *
     * @param string $image
     *
     * @return DatabaseUserVariables
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return DatabaseUserVariables
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
}

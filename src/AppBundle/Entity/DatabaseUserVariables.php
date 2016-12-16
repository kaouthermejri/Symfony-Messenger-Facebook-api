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
     * @ORM\Column(type="string",length=64)
     */
    private $email;

    /**
     * @ORM\Column(type="string",length=120)
     */
    private $password;

    /**
     * @ORM\Column(type="string", name="category", length=120)
     */
    public $category;

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
     * @return string
     */
    public function getUsername()
    {
        return $this->name_surname;
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
     * @return string
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
        return array('ROLE_ADMIN');
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
}

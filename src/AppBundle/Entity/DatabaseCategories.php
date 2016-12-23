<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/15/2016
 * Time: 3:21 PM
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="Categories")
 */
class DatabaseCategories
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", name="category", length=100)
     */
    public $category;

    /**
     * @ORM\Column(type="integer", name="parent", length=100, nullable=true)
     */
    public $parent;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DatabaseCanTeach", mappedBy="parent_id")
     */
    public $can_teach_parent;

    public function __construct()
    {
        return $this->can_teach_parent= new ArrayCollection();
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
     * Set category
     *
     * @param string $category
     *
     * @return DatabaseCategories
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
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * Add canTeachParent
     *
     * @param \AppBundle\Entity\DatabaseCanTeach $canTeachParent
     *
     * @return DatabaseCategories
     */
    public function addCanTeachParent(\AppBundle\Entity\DatabaseCanTeach $canTeachParent)
    {
        $this->can_teach_parent[] = $canTeachParent;

        return $this;
    }

    /**
     * Remove canTeachParent
     *
     * @param \AppBundle\Entity\DatabaseCanTeach $canTeachParent
     */
    public function removeCanTeachParent(\AppBundle\Entity\DatabaseCanTeach $canTeachParent)
    {
        $this->can_teach_parent->removeElement($canTeachParent);
    }

    /**
     * Get canTeachParent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCanTeachParent()
    {
        return $this->can_teach_parent;
    }
}

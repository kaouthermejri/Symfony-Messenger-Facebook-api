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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DatabaseSubCategories", mappedBy="category_id")
     */
    public $sub_categories;

    public function __construct()
    {
        $this->sub_categories= new ArrayCollection();
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
     * Add subCategory
     *
     * @param \AppBundle\Entity\DatabaseSubCategories $subCategory
     *
     * @return DatabaseCategories
     */
    public function addSubCategory(\AppBundle\Entity\DatabaseSubCategories $subCategory)
    {
        $this->sub_categories[] = $subCategory;

        return $this;
    }

    /**
     * Remove subCategory
     *
     * @param \AppBundle\Entity\DatabaseSubCategories $subCategory
     */
    public function removeSubCategory(\AppBundle\Entity\DatabaseSubCategories $subCategory)
    {
        $this->sub_categories->removeElement($subCategory);
    }

    /**
     * Get subCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubCategories()
    {
        return $this->sub_categories;
    }
}

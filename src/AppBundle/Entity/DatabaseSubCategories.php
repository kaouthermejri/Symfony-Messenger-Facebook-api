<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/16/2016
 * Time: 10:29 AM
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity()
 * @ORM\Table(name="sub_categories")
 */
class DatabaseSubCategories
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DatabaseCategories", inversedBy="sub_categories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    public $category_id;

    /**
     * @ORM\Column(type="string", name="category", length=120)
     */
    public $category;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DatabaseCanTeach", mappedBy="sub_category_id")
     */
    public $sub_category;

    public function __construct()
    {
        return $this->sub_category =new ArrayCollection();
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
     * @return DatabaseSubCategories
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
     * Set categoryId
     *
     * @param \AppBundle\Entity\DatabaseCategories $categoryId
     *
     * @return DatabaseSubCategories
     */
    public function setCategoryId(\AppBundle\Entity\DatabaseCategories $categoryId = null)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return \AppBundle\Entity\DatabaseCategories
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Add subCategory
     *
     * @param \AppBundle\Entity\DatabaseCanTeach $subCategory
     *
     * @return DatabaseSubCategories
     */
    public function addSubCategory(\AppBundle\Entity\DatabaseCanTeach $subCategory)
    {
        $this->sub_category[] = $subCategory;

        return $this;
    }

    /**
     * Remove subCategory
     *
     * @param \AppBundle\Entity\DatabaseCanTeach $subCategory
     */
    public function removeSubCategory(\AppBundle\Entity\DatabaseCanTeach $subCategory)
    {
        $this->sub_category->removeElement($subCategory);
    }

    /**
     * Get subCategory
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubCategory()
    {
        return $this->sub_category;
    }
}

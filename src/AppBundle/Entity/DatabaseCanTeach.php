<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/16/2016
 * Time: 11:42 AM
 */

namespace AppBundle\Entity;
use  Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="can_teach")
 */
class DatabaseCanTeach
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DatabaseUserVariables", inversedBy="can_teach")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */

    public $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DatabaseSubCategories", inversedBy="sub_category")
     * @ORM\JoinColumn(name="sub_category_id", referencedColumnName="id", onDelete="CASCADE")
     */

    public $sub_category_id;

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
     * Set userId
     *
     * @param \AppBundle\Entity\DatabaseUserVariables $userId
     *
     * @return DatabaseCanTeach
     */
    public function setUserId(\AppBundle\Entity\DatabaseUserVariables $userId = null)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\DatabaseUserVariables
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set subCategoryId
     *
     * @param \AppBundle\Entity\DatabaseSubCategories $subCategoryId
     *
     * @return DatabaseCanTeach
     */
    public function setSubCategoryId(\AppBundle\Entity\DatabaseSubCategories $subCategoryId = null)
    {
        $this->sub_category_id = $subCategoryId;

        return $this;
    }

    /**
     * Get subCategoryId
     *
     * @return \AppBundle\Entity\DatabaseSubCategories
     */
    public function getSubCategoryId()
    {
        return $this->sub_category_id;
    }
}

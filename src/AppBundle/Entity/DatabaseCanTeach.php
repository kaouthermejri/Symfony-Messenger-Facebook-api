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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FosUser", inversedBy="can_teach")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */

    public $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DatabaseCategories", inversedBy="can_teach_parent")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */

    public $parent_id;

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
     * @param \AppBundle\Entity\FosUser $userId
     *
     * @return DatabaseCanTeach
     */
    public function setUserId(\AppBundle\Entity\FosUser $userId = null)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\FosUser
     */
    public function getUserId()
    {
        return $this->user_id;
    }



    /**
     * Set parentId
     *
     * @param \AppBundle\Entity\DatabaseCategories $parentId
     *
     * @return DatabaseCanTeach
     */
    public function setParentId(\AppBundle\Entity\DatabaseCategories $parentId = null)
    {
        $this->parent_id = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return \AppBundle\Entity\DatabaseCategories
     */
    public function getParentId()
    {
        return $this->parent_id;
    }
}

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
}
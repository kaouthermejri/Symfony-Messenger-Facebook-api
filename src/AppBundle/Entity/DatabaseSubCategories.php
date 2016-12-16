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










}
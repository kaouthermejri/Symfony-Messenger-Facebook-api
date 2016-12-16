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


}
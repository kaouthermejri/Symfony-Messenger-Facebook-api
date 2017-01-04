<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 1/2/2017
 * Time: 2:05 PM
 */

namespace AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\DatabaseCategories;

class AdminCategories extends Controller
{
    /**
     * @Route("/3", name="adminCategories")
     */
    public function AddCategories(){
        $admin=$this->getUser();
        if (empty($admin)){
            exit('Jūs neturite priejimo prie šios funkcijos');
        }
        $categories=$this->getDoctrine()->getRepository("AppBundle:DatabaseCategories")->findBy(array(
            'parent'=>null
        ));



        return $this->render(':Admin:admin_categories.html.twig', array(
            'categories'=>$categories
        ));

    }
}
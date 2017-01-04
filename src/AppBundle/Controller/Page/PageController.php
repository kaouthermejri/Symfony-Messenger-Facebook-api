<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 1/3/2017
 * Time: 3:26 PM
 */

namespace AppBundle\Controller\Page;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class PageController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function homePage(){
        return $this->render('index.html.twig');
    }
}
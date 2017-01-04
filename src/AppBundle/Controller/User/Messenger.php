<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 1/3/2017
 * Time: 11:13 AM
 */

namespace AppBundle\Controller\User;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class Messenger extends Controller
{
    /**
     * @Route("/zinutes", name="zinutes")
     */
    public function messageAction(){
        $user=$this->getUser();
        if (empty($user)){
            $this->redirectToRoute('prisijungti');
        }
        return $this->render('zinutes.html.twig');
    }
}
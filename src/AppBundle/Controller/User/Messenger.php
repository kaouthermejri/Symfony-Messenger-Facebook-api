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

    public function messageAction()
    {

        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $provider = $this->get('fos_message.provider');
        $threads = $provider->getInboxThreads();


        return $this->render('zinutes.html.twig', array(
            'message' => $threads
        ));

    }




}
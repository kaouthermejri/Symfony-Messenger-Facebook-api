<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/9/2016
 * Time: 11:59 AM
 */

namespace AppBundle\Controller\User;


use AppBundle\Entity\ResetPassVariables;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class UserLoginController extends Controller
{


    public function LoginAction()
    {
        $user = $this->getUser();
        if (!empty($user)) {
            return $this->redirectToRoute('index');
        }


        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('prisijungti.html.twig', array(
            'error' => $error,
            'last_username' => $lastUsername
        ));
    }

    /**
     * @Route("/user/login_check", name="user_login_check")
     */
    public function loginCheckAction()
    {
        exit('neturetu but vykdomas');
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()    {

    }





}
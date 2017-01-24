<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/22/2016
 * Time: 11:45 AM
 */

namespace AppBundle\Controller\User;


use AppBundle\Entity\DatabaseUserVariables;
use AppBundle\Entity\FosUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class Register extends Controller
{


    /**
     * @Route("/registracija", name="registracija")
     */
    public function RegistrationAction(Request $request){
        $user = $this->getUser();
        if (!empty($user)) {
            return $this->redirectToRoute('index');
        }
        $user= new FosUser();
        $form=$this->createForm('AppBundle\Form\SignupForm', $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $passwod=$this->get('security.password_encoder')->encodePassword($user,$user->getPassword());
            $user->setPassword($passwod);
            $user->setEnabled('1');
            $user->setTemporaryImage('user-default.png');
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('fos_user_security_login');
        }
        return $this->render('registracija.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
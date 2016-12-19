<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/9/2016
 * Time: 11:59 AM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\DatabaseUserVariables;
use AppBundle\Entity\RememberVariables;
use AppBundle\Entity\ResetPassVariables;
use AppBundle\Form\CategoryFormData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class UserLoginController extends Controller
{

    /**
     * @Route("/prisijungti", name="prisijungti")
     */
    public function LoginAction(){

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('prisijungti.html.twig', array(
            'error'         => $error,
            'last_username' => $lastUsername
        ));
    }

    /**
     * @Route("/registracija", name="registracija")
     */
    public function RegistrationAction(Request $request){
        $user= new DatabaseUserVariables();
        $form=$this->createForm('AppBundle\Form\SignupForm',$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('prisijungti');
        }
        return $this->render('registracija.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        exit('neturetu but vykdomas');
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }


    /**
     * @Route ("/priminti_slaptazodi" ,name="priminti_slaptazodi")
     */
    public function RememberAction(Request $request){

        $remember=new RememberVariables();
        $form=$this->createForm('AppBundle\Form\RememberPasswordForm',$remember);
        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            $user=$this->getDoctrine()->getRepository("AppBundle:DatabaseUserVariables")->findOneBy(array(
                'email'=>$remember->email
            ));
            $message=\Swift_Message::newInstance()
                ->setSubject('Slaptažodžio priminimas')
                ->setFrom("egidijuslaucevicius@yahoo.com")
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('Email\atnaujintiSlaptazodi.html.twig', array(
                        'password'=>$user->getPlainPassword(),
                        'namesurname'=>$user->getNameSurname(),
                        'id'=>$user->getId()
                    )),
                    'text\html'
                );
                $this->get('mailer')->send($message);
                return $this->redirectToRoute("prisijungti");
            }
        }


        return $this->render("primintiSlaptazodi.html.twig", array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/atnaujinti_slaptazodi/{id}", name="atnaujinti_slaptazodi")
     */
    public function ResetPasswordAction(Request $request, $id){
        $user=$this->getDoctrine()->getRepository('AppBundle:DatabaseUserVariables')->find($id);
        if (!$id) {
            throw $this->createNotFoundException(
                'No user found for id ' . $id
            );
        }
        $reset= new DatabaseUserVariables();
        $form=$this->createForm('AppBundle\Form\ResetPasswordForm', $reset);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('prisijungti');
       }
        return $this->render("ivestiNaujaslaptazodi.html.twig", array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/kas_tu_esi", name="kas_tu_esi")
     */
    public function WhoAreYouAction(Request $request){

        $user=$this->getUser();

        if(empty($user)){
            exit('esi neprisijunges.');
        }

        $category= new CategoryFormData();
        $form=$this->createForm('AppBundle\Form\CategoryForm', $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            if ($form->get('senjoras')->isClicked()) {
                $user->setCategory('senjoras');
            }elseif ($form->get('jaunuolis')->isClicked()) {
                $user->setCategory('jaunuolis');
            }
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("ko_nori_ismokti");
        }
        return $this->render("kas_tu_esi.html.twig", array(
            'form'=>$form->createView()
        ));
    }




}
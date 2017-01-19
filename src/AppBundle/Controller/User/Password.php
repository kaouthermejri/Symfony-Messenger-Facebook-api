<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/22/2016
 * Time: 12:08 PM
 */

namespace AppBundle\Controller\User;

use AppBundle\Entity\DatabaseUserVariables;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\RememberVariables;
use AppBundle\Entity\UpdateUserPass;

class Password extends Controller
{


    /**
     * @Route("/mano_paskyra/redaguoti/slaptazodis", name="redaguoti_slaptazodi")
     */
    public function RedaguotiUserSlaptazodi(Request $request)
    {
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $update_password = new UpdateUserPass();

        $form = $this->createForm('AppBundle\Form\UpdateUserPassForm', $update_password);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $update_password->newPassword);
            $user->setPassword($password);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('prisijungti');
        }
        return $this->render('keisti_slaptazodi.html.twig', array(
            'form' => $form->createView()
        ));

    }



    /**
     * @Route("/atnaujinti_slaptazodi/{id}", name="atnaujinti_slaptazodi")
     */
    public function ResetPasswordAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:DatabaseUserVariables')->findOneBy(array(
            'id' => $id
        ));
        if (empty($user)) {
            exit('Tokio vartotojo nera');
        }
        $reset = new DatabaseUserVariables();
        $form = $this->createForm('AppBundle\Form\ResetPasswordForm', $reset);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $reset->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('prisijungti');
        }
        return $this->render("ivestiNaujaslaptazodi.html.twig", array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    /**
     * @Route ("/priminti_slaptazodi" ,name="priminti_slaptazodi")
     */
    public function RememberAction(Request $request){
        $remember = new RememberVariables();
        $form=$this->createForm('AppBundle\Form\RememberPasswordForm', $remember);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $this->getDoctrine()->getRepository('AppBundle:DatabaseUserVariables')->findOneBy(array(
                'email'=>$remember->email
            ));
            if (empty($user)){
                exit('Tokio Vartotojo nėra');
            }
            $message = \Swift_Message::newInstance()
                ->setSubject('Slaptažodžio priminimas')
                ->setFrom("egidijuslaucevicius@yahoo.com")
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('Email\atnaujintiSlaptazodi.html.twig', array(
                        'password' => $user->getPlainPassword(),
                        'namesurname' => $user->getNameSurname(),
                        'id' => $user->getId()
                    )),
                    'text\html'
                );
            $this->get('mailer')->send($message);
            return $this->redirectToRoute("prisijungti");

        }
        return $this->render("primintiSlaptazodi.html.twig", array(
            'form' => $form->createView()
        ));
    }

}
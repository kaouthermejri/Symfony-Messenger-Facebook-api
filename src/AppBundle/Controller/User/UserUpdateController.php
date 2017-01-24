<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/22/2016
 * Time: 2:52 PM
 */

namespace AppBundle\Controller\User;


use AppBundle\Entity\UserImage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\UserUpdateVar;
use AppBundle\Entity\DatabaseUserVariables;

class UserUpdateController extends Controller
{
    /**
     * @Route("/mano_paskyra", name="mano_paskyra")
     */
    public function UserPaskyra()
    {
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }


        $cant_teach = $this->getDoctrine()->getRepository('AppBundle:DatabaseCanTeach')->findBy(array(
            'user_id' => $user,
        ));
        $image=$user->getImage();

        if (empty($image)){
             $image=$user->getTemporaryImage();
        }
        return $this->render("mano_paskyra.html.twig", array(
            'name_surname' => $user->getUsername(),
            'email' => $user->getEmail(),
            'image' => $image,
            'can_teach' => $cant_teach

        ));

    }



    /**
     * @Route("/mano_paskyra/redaguoti", name="paskyros_redagavimas")
     */
    public function RedaguotiUser(Request $request)
    {

        /*
         * @var $user DatabaseUserVariables
         * */
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $user_update = new UserUpdateVar();
        $user_update->username = $user->getUsername();
        $user_update->email = $user->getEmail();
        $user_update->phone_number = $user->getPhoneNumber();

        $form = $this->createForm('AppBundle\Form\UserUpdateForm', $user_update);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($user_update->username);
            $user->setEmail($user_update->email);
            $user->setPhoneNumber($user_update->phone_number);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('mano_paskyra');
        }
        $image=$user->getImage();

        if (empty($image)){
            $image=$user->getTemporaryImage();
        }

        return $this->render("mano_paskyra_redaguoti.html.twig", array(
            'form' => $form->createView(),
            'image' => $image,
        ));
    }


    /**
     * @Route("/mano_paskyra/redaguoti/nuotrauka", name="redaguoti_nuotrauka")
     */
    public function RedaguotiUserNuotrauka(Request $request)
    {
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $image=$user->getImage();

        if (empty($image)){
            $image=$user->getTemporaryImage();
        }


        $user_image = new UserImage();

        $form = $this->createForm('AppBundle\Form\UserImageForm', $user_image);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Symfony\Component\HttpFoundation\File\UploadedFile $file
             */
            $file=$user_image->getImage();
            $filesystem=new Filesystem();
            if ((!empty($user->getImage()))){
                $filename=pathinfo($user->getImage());
                $name=$filename['filename'];
                $mask="$name.";
                $extensions=array('jpg','gif','png','jpeg');
                foreach ($extensions as $all) {
                    $delete = $this->getParameter('image_directory') . '/' . $mask . $all;
                    $filesystem->remove($delete);
                }

            }
                $imageName = strtolower($user->getEmail() . '.' . $file->guessExtension());

                $file->move(
                    $this->getParameter('image_directory'),
                    $imageName
                );

                $user_image->setImage($imageName);
                $user->setImage($imageName);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('mano_paskyra');
            }



        return $this->render("keisti_nuotrauka.html.twig", array(
            'form' => $form->createView(),
            'image'=> $image,
        ));

    }

}
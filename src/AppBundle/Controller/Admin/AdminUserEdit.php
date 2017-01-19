<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/30/2016
 * Time: 10:52 AM
 */

namespace AppBundle\Controller\Admin;
use AppBundle\Entity\AdminEditUser;
use AppBundle\Form\AdminUserEditForm;
use AppBundle\Entity\AdminUserSearchVar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;

class AdminUserEdit extends Controller
{
    /**
     * @Route("/1", name="home")
     */
    public function UserList(Request $request)
    {
        $admin = $this->getUser();
        if (empty($admin)) {
//            $this->redirectToRoute('prisijungti');
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $user = $this->getDoctrine()->getRepository('AppBundle:FosUser')->findAll();

        $userSearch = new AdminUserSearchVar();

        $form = $this->createForm('AppBundle\Form\AdminUserSearch', $userSearch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            exit();

        }
        return $this->render(':Admin:user_list.html.twig',array(
           'user'=>$user,
            'form'=>$form->createView()
        ));

    }

    /**
     * @Route("/2/{id}", name="userEdit")
     * @var Symfony\Component\HttpFoundation\File\UploadedFile $file
     */
    public function editUser(Request $request, $id){

        $admin = $this->getUser();
        if (empty($admin)) {
            $this->redirectToRoute('fos_user_security_login');
        }
        $user = $this->getDoctrine()->getRepository('AppBundle:FosUser')->find($id);



        $editForm=new AdminEditUser();

        $editForm->username=$user->getUsername();
        $editForm->email=$user->getEmail();
        $editForm->phone_number=$user->getPhoneNumber();
        $editForm->category=$user->getCategory();

        $imageFile = new File( $this->getParameter('image_directory') . '/'.$user->getImage());


        $editForm->image=$imageFile;

        $form=$this->createForm('AppBundle\Form\AdminUserEditForm',$editForm);




        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $user->setUsername($editForm->username);
            $user->setEmail($editForm->email);
            $user->setPhoneNumber($editForm->phone_number);
            $user->setCategory($editForm->category);
            $password=$this->get('security.password_encoder')->encodePassword($user, $editForm->password);
            $user->setPassword($password);




            $file=$editForm->getImage();

            $filesystem=new Filesystem();
            $delete=$this->getParameter('image_directory').$user->getImage();
            $filesystem->remove($delete);
            $imageName=$user->getEmail().'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),
                $imageName
            );

            $editForm->setImage($imageName);
            $user->setImage($imageName);


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render(':Admin:user_edit.html.twig',array(
            'form'=>$form->createView(),
            'picture'=>$user->getImage(),
            'user'=>$user->getUsername(),
            'id'=>$user->getId()
        ));
    }


    /**
     * @Route("/1/delete/{id}", name="UserDelete")
     */
    public function DeleteUser($id){
        $admin=$this->getUser();
        if (empty($admin)){
            exit('Jūs neturite priejimo prie šios funkcijos');
        }
        $user = $this->getDoctrine()->getRepository("AppBundle:DatabaseUserVariables")->find($id);

        $filesystem=new Filesystem();
        $delete=$this->getParameter('image_directory').$user->getImage();
        $filesystem->remove($delete);

        $em = $this->getDoctrine()->getManager();

        $em->remove($user);

        $em->flush();

        return $this->redirectToRoute('home');


    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/22/2016
 * Time: 2:56 PM
 */

namespace AppBundle\Controller\User;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\CategoryFormData;
use AppBundle\Entity\DatabaseCanTeach;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
Use AppBundle\Entity\DatabaseCategories;

class CategoryController extends Controller
{
    /**
     * @Route("/kas_tu_esi", name="kas_tu_esi")
     */
    public function WhoAreYouAction(Request $request)
    {
        $user = $this->getUser();
        if (empty($user)) {
            exit('esi neprisijunges.');
        }
        $check=$user->getCategory();

        if ($check != null){
            return $this->redirect($this->generateUrl('ko_nori_ismokti'));
        }

        $category = new CategoryFormData();
        $form = $this->createForm('AppBundle\Form\CategoryForm', $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('senjoras')->isClicked()) {
                $user->setCategory('senjoras');
            } elseif ($form->get('jaunuolis')->isClicked()) {
                $user->setCategory('jaunuolis');
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("ko_nori_ismokti");
        }
        return $this->render("kas_tu_esi.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ko_nori_ismokti", name="ko_nori_ismokti")
     */
    public function WantToLearnAction()
    {
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $categories = $this->getDoctrine()->getRepository("AppBundle:DatabaseCategories")->findBy(array(
            'parent'=>null
        ));
        return $this->render("ko_nori_ismokti.html.twig", array(
            'categories' => $categories
        ));


    }

    /**
     * @Route("/ko_nori_ismokti/{categoryId}", name="ko_nori_ismokti_sub")
     */
    public function WantToLearnSubAction($categoryId)
    {
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $categories = $this->getDoctrine()->getRepository('AppBundle:DatabaseCategories')->findOneBy(array(
            'id' => $categoryId
        ));
        if (empty($categories)){
            return $this->redirectToRoute('ko_nori_ismokti');
        }
        $sub_categories = $this->getDoctrine()->getRepository('AppBundle:DatabaseCategories')->findBy(array(
            'parent' => $categories->getId()
        ));
        return $this->render('ko_nori_ismokti_sub.html.twig', array(
            'categories' => $sub_categories,
            'category' => $categories,
            'categoryId' => $categoryId
        ));

    }

    /**
     * @Route("/ko_nori_ismokti/{categoryId}/{sub_categoryId}", name="ko_nori_ismokti_Teachers")
     */
    public function WantToLearnTeachersAction($categoryId, $sub_categoryId)
    {
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $sub_category_id = $this->getDoctrine()->getRepository('AppBundle:DatabaseCategories')->findOneBy(array(
            'id' => $sub_categoryId
        ));
        if (empty($sub_categoryId)){
            return $this->redirectToRoute('ko_nori_ismokti');
        }
        $sub_category_all = $this->getDoctrine()->getRepository('AppBundle:DatabaseCanTeach')->findBy(array(
            'parent_id' => $sub_category_id->getId()

        ));
        return $this->render("ko_nori_ismokti_teachers.html.twig", array(
            'canTeach' => $sub_category_all,
            'sub_categoryId' => $categoryId,
            'sub_category'   => $sub_category_id
        ));
    }

    /**
     * @Route("/galiu_ismokyti", name="galiu_ismokyti")
     */
    public function CanTeach()
    {
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $categories = $this->getDoctrine()->getRepository("AppBundle:DatabaseCategories")->findBy(array(
            'parent'=>null
        ));
        return $this->render("galiu_ismokyti.html.twig", array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/galiu_ismokyti/{categoryId}", name="galiu_ismokyti_category")
     *
     */
    public function CanTeachSub(Request $request, $categoryId)
    {
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $categoriesRepository = $this->getDoctrine()->getRepository('AppBundle:DatabaseCategories');

        $category = $categoriesRepository->findOneBy(array(
            'id' => $categoryId
        ));
        if (empty($category)){
            return $this->redirectToRoute('galiu_ismokyti');
        }
        $sub_categories = $categoriesRepository->findBy(array(
            'parent' => $category->getId()
        ));
        if($request->getMethod() === 'POST'){
            $subcategoryId = filter_input(INPUT_POST, 'parent', FILTER_VALIDATE_INT);
            $parent=$this->getDoctrine()->getRepository('AppBundle:DatabaseCategories')->findOneBy(array(
                'id'=>$subcategoryId
            ));

            $can_teach = new DatabaseCanTeach();

            $can_teach->setParentId($parent);
            $can_teach->setUserId($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($can_teach);
            $em->flush();

            return $this->redirectToRoute('mano_paskyra');
        }


        return $this->render('galiu_ismokyti_sub.html.twig', array(
            'categories' => $sub_categories,
            'category' => $category
        ));
    }

    /**
     * @Route("/delete/parent_kategorija/{id}")
     */
    public function deleteCanTeach($id){
        $user = $this->getUser();
        if (empty($user)) {
            return $this->redirectToRoute("fos_user_security_login");
        }
        $cant_teach = $this->getDoctrine()->getRepository('AppBundle:DatabaseCanTeach')->findOneBy(array(
            'user_id' =>$user
        ));
        $em = $this->getDoctrine()->getManager();
        $em->remove($cant_teach);
        $em->flush();
        return $this->redirectToRoute('mano_paskyra');
    }

}
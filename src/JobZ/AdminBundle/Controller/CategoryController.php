<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 16.
 * Time: 0:11
 */

namespace JobZ\AdminBundle\Controller;

use JobZ\HomeBundle\Entity\Category;
use JobZ\HomeBundle\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 * @package JobZ\AdminBundle\Controller
 * 
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('HomeBundle:Category')->findAll();

        return $this->render('AdminBundle:Category:index.html.twig', array('categories' => $categories,));
    }

    /**
     * @param Category $category
     * @return Response
     *
     * @Route("/{id}")
     * @Method("GET")
     */
    public function showAction(Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        return $this->render('AdminBundle:Category:show.html.twig', array('category' => $category, 'delete_form' =>
            $deleteForm->createView(),));
    }

    /**
     *
     * @param Request $request
     * @param Category $category
     *
     * @return Response
     *
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('JobZ\HomeBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('jobz_admin_category_edit', array('id' => $category->getId()));
        }
        return $this->render('AdminBundle:Category:index.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()));
    }

    /**
     * @param Request $request
     * @param Category $category
     *
     * @return Response
     *
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush($category);
        }
        return $this->redirectToRoute('jobz_admin_category_index');
    }

    /**
     * @param Category $category
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()->setAction($this->generateUrl('jobz_admin_category_delete', array('id' =>
                $category->getId())
        ))->setMethod('DELETE')->getForm();
    }
    
}
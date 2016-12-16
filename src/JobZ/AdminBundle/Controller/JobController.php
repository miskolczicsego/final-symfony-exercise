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
 * Class JobController
 * @package JobZ\AdminBundle\Controller
 * @Route("/job")
 */
class JobController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jobs = $em->getRepository('HomeBundle:Job')->findAll();

        return $this->render('AdminBundle:Job:index.html.twig', array('jobs' => $jobs,));
    }

    /**
     * @return Response
     *
     * @Route("/{id}")
     * @Method("GET")
     */
    public function showAction(Job $job)
    {
        $deleteForm = $this->createDeleteForm($job);
        return $this->render('AdminBundle:Job:show.html.twig', array('job' => $job, 'delete_form' =>
            $deleteForm->createView(),));
    }

    /**
     *
     * @param Request $request
     * @param Job $job
     *
     * @return Response
     *
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Job $job)
    {
        $deleteForm = $this->createDeleteForm($job);
        $editForm = $this->createForm('JobZ\HomeBundle\Form\JobType', $job);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('jobz_admin_job_index', array('id' => $job->getId()));
        }
        return $this->render('AdminBundle:Job:edit.html.twig', array('job' => $job, 'edit_form' =>
            $editForm->createView(), 'delete_form' => $deleteForm->createView()));
    }

    /**
     * @param Request $request
     * @param Job $job
     *
     * @return Response
     *
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Job $job)
    {
        $form = $this->createDeleteForm($job);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush($job);
        }
        return $this->redirectToRoute('jobz_admin_job_index');
    }

    /**
     * @param Job $job The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Job $job)
    {
        return $this->createFormBuilder()->setAction($this->generateUrl('jobz_admin_job_delete', array('id' =>
                $job->getId())
        ))->setMethod('DELETE')->getForm();
    }
}
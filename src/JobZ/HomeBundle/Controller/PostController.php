<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 15.
 * Time: 20:05
 */

namespace JobZ\HomeBundle\Controller;


use JobZ\HomeBundle\Entity\Job;
use JobZ\HomeBundle\Form\JobType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush($job);
            return $this->redirectToRoute('jobz_home_default_index');
        }
        return $this->render('HomeBundle:Post:new.html.twig', array('job' => $job, 'form' => $form->createView(),));
    }
}
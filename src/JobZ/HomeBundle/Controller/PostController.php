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

/**
 * Class PostController
 * @package JobZ\HomeBundle\Controller
 *
 * @Route("/new")
 */
class PostController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/post")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
                $em->persist($job);
                $em->flush($job);
                return $this->redirectToRoute('jobz_home_job_index');
            } else {
                $this->addFlash(
                    'notice',
                    'Please login to post job'
                );
                return $this->redirect($this->generateUrl('jobz_home_login_login'));
            }

        }
        return $this->render('HomeBundle:Post:new.html.twig', array('job' => $job, 'form' => $form->createView(),));
    }
}
<?php
/**
 * Az osztály rövid leírása
 *
 * Az osztály hosszú leírása, példakód
 * akár több sorban is
 *
 * @author miskolczicsego
 * @since 2016.12.14. 14:16
 */

namespace JobZ\HomeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Class JobController
 * @package JobZ\HomeBundle\Controller
 *
 */
class JobController extends Controller
{
    /**
     * @Route("/jobs")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('HomeBundle:Category')->findAll();
        $jobRepository = $em->getRepository('HomeBundle:Job');
        $jobs = array();
        foreach ($categories as $category) {
            $jobs[$category->getName()] = $jobRepository->getLastActiveJobsByCategory($category);
        }

        return $this->render(
            '@Home/Job/jobs.html.twig',
            array(
                'lastjobs' => $jobs
            )
        );
    }

    /**
     * @param $category
     * @return Response
     *
     * @Route("/{slug}")
     */
    public function jobListerAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('HomeBundle:Category')->findBy(
            array(
                'slug' => $slug
            )
        );

        $jobsToCategory = $em->getRepository('HomeBundle:Job')->findBy(array('category' => $category));

        return $this->render(
            'HomeBundle:Job:_job.html.twig',
            array(
                'jobs' => $jobsToCategory
            )
        );
    }
}
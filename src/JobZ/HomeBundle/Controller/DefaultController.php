<?php

namespace JobZ\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Class DefaultController
 * @package JobZ\HomeBundle\Controller
 * @Route("/")
 */
class DefaultController extends Controller
{

    /**
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('jobz_home_job_index'));
    }
}

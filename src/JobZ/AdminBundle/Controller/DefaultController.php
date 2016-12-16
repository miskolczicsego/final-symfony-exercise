<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 16.
 * Time: 2:28
 */

namespace JobZ\AdminBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * Redirection
     *
     * @Route("/")
     * @return RedirectResponse
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('jobz_admin_job_index'));
    }
}
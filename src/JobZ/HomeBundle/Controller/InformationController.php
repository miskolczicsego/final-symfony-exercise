<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 15.
 * Time: 2:14
 */

namespace JobZ\HomeBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InformationController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/info")
     */
    public function infoAction()
    {
        return $this->render('@Home/Information/information.html.twig');
    }

}
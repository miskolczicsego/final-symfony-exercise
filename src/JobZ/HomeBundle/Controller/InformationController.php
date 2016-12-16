<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 15.
 * Time: 2:14
 */

namespace JobZ\HomeBundle\Controller;


use JobZ\HomeBundle\Entity\Information;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InformationController extends Controller
{
    /**
     * @Route("/information/{id}")
     */
    public function indexAction(Information $information)
    {
        return $this->render(
            'HomeBundle:Information:information.html.twig',
            array(
                'information' => $information
            )
        );
    }

}
<?php
namespace JobZ\HomeBundle\Controller;

use JobZ\HomeBundle\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MenuController extends Controller
{
    public function headerAction()
    {
        $menus = $this->getMenus("Header");
        return $this->render(
            'HomeBundle:Menu:index.html.twig',
            array(
                'menus' => $menus,
            )
        );
    }
    public function footerAction()
    {
        $menus = $this->getMenus("Footer");
        return $this->render(
            'HomeBundle:Menu:index.html.twig',
            array(
                'menus' => $menus,
            )
        );
    }
    private function getMenus($position)
    {
        $menus = $this->getDoctrine()->getRepository('HomeBundle:Menu')->findAll();
        $actMenus = array();
        foreach($menus as $menu) {
            if($menu->getPosition() == $position) {
                $actMenus[] = $menu;
            }
        }
        return $actMenus;
    }
}
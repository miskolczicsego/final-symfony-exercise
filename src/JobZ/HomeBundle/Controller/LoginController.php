<?php
/**
 * Az osztály rövid leírása
 *
 * Az osztály hosszú leírása, példakód
 * akár több sorban is
 *
 * @author miskolczicsego
 * @since 2016.12.14. 15:48
 */

namespace JobZ\HomeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Class LoginController
 * @package JobZ\HomeBundle\Controller
 *
 * @Route("/")
 */
class LoginController extends Controller
{

    /**
     * @return Response
     * @Route("/login")
     */
    public function loginAction()
    {
        $request = $this->container->get('request');
        $session = $this->container->get('session');
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render(
            '@Home/Security/login.html.twig',
            array(
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error
            )
        );
    }

    /**
     * Login check
     *
     * @Route("/login_check")
     */
    public function loginCheckAction()
    {

    }
    /**
     * Logout action
     *
     * @Route("/logout")
     */
    public function logoutAction()
    {

    }
}
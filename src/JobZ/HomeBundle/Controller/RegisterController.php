<?php
/**
 * Az osztály rövid leírása
 *
 * Az osztály hosszú leírása, példakód
 * akár több sorban is
 *
 * @author miskolczicsego
 * @since 2016.12.14. 14:55
 */

namespace JobZ\HomeBundle\Controller;

use JobZ\HomeBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use JobZ\HomeBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class RegisterController
 * @package JobZ\HomeBundle\Controller
 *
 * @Route("/register")
 */
class RegisterController extends Controller
{
    /**
     * @Route("/")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('jobz_home_job_index');
        }
        return $this->render('@Home/Security/registration.html.twig', array('form' => $form->createView()));
    }
}
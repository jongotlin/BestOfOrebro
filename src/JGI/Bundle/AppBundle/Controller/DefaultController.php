<?php

namespace JGI\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine')->getManager();
        $posts = $em->getRepository('JGIAppBundle:Post')->getPostsForFirstPage();

        $response = $this->render('JGIAppBundle:Default:index.html.twig', ['posts' => $posts]);
        $response->setMaxAge(600);
        $response->setSharedMaxAge(600);

        return $response;
    }
}

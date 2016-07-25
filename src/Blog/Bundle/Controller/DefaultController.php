<?php

namespace Blog\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();

      $articles = $em->getRepository('BlogBundle:Article')->findAll();

      return $this->render('BlogBundle:Default:index.html.twig', array(
          'articles' => $articles,
      ));

    }
}

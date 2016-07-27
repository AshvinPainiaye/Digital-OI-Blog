<?php

namespace Blog\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class DefaultController extends Controller
{
    /**
     * @Route("/" ,name="accueil")
     */
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();

      $articles = $em->getRepository('BlogBundle:Article')->findBy(array('disponibilite' =>'Publique'));

      return $this->render('BlogBundle:Default:index.html.twig', array(
          'articles' => $articles,
      ));

    }


/**
 * @route("/brouillon")
 */
    public function brouillonAction()
    {
      $em = $this->getDoctrine()->getManager();

      $articles = $em->getRepository('BlogBundle:Article')->findBy(array('disponibilite' =>'Brouillon'));

      return $this->render('BlogBundle:Default:index.html.twig', array(
          'articles' => $articles,
      ));
    }


    /**
     * @Route("/all/articles")
     */
    public function allArticlesAction()
    {
      $em = $this->getDoctrine()->getManager();

      $articles = $em->getRepository('BlogBundle:Article')->findBy(array('disponibilite' =>'Publique'));

      return $this->render('BlogBundle:Default:allArticle.html.twig', array(
          'articles' => $articles,
      ));

    }

}

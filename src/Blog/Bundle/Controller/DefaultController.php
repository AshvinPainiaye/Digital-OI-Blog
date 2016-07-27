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
     * @route("/mes-articles")
     */
        public function mesArticleAction()
        {
          $user = $this->getUser();

          $em = $this->getDoctrine()->getManager();

          $articles = $em->getRepository('BlogBundle:Article')->findBy(['user'=>$user]);

          return $this->render('article/mes-articles.html.twig', array(
              'articles' => $articles,
               'user' => $user,
          ));
        }

}

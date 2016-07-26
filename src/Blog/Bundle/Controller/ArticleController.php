<?php

namespace Blog\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Blog\Bundle\Entity\Article;
use Blog\Bundle\Form\ArticleType;

// use Vich\UploaderBundle\Form\Type\VichImageType;

/**
* Article controller.
*
* @Route("/article")
*/
class ArticleController extends Controller
{
  /**
  * Lists all Article entities.
  *
  * @Route("/", name="article_index")
  * @Method("GET")
  */
  public function indexAction()
  {

    $em = $this->getDoctrine()->getManager();
    $user = $this->getUser();
    $articles = $em->getRepository('BlogBundle:Article')->findBy(['user'=>$user]);
    return $this->render('article/index.html.twig', array(
      'articles' => $articles,
      'user' => $user,
    ));
  }

  // /**
  // * Lists all Article entities.
  // *
  // * @Route("/", name="article_index")
  // * @Method("GET")
  // */
  // public function indexAction()
  // {
  //
  //   $em = $this->getDoctrine()->getManager();
  //
  //   $articles = $em->getRepository('BlogBundle:Article')->findAll();
  //   return $this->render('article/index.html.twig', array(
  //     'articles' => $articles,
  //   ));
  // }


  /**
  * Creates a new Article entity.
  *
  * @Route("/new", name="article_new")
  * @Method({"GET", "POST"})
  */
  public function newAction(Request $request)
  {
    $article = new Article();
    $article->setDate(new \DateTime('now'));
    $form = $this->createForm('Blog\Bundle\Form\ArticleType', $article);
    $form->handleRequest($request);

    $userId = $this->getUser();
    $userId->getId();
    $article->setUser($userId);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($article);
      $em->flush();

    return $this->redirectToRoute('accueil'/*, array('id' => $article->getId())*/);
    }

    return $this->render('article/new.html.twig', array(
      'article' => $article,
      'form' => $form->createView(),
    ));
  }

  /**
  * Finds and displays a Article entity.
  *
  * @Route("/{id}", name="article_show")
  * @Method("GET")
  */
  public function showAction(Article $article)
  {
    $deleteForm = $this->createDeleteForm($article);

    return $this->render('article/show.html.twig', array(
      'article' => $article,
      'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
  * Displays a form to edit an existing Article entity.
  *
  * @Route("/{id}/edit", name="article_edit")
  * @Method({"GET", "POST"})
  */
  public function editAction(Request $request, Article $article)
  {
    $deleteForm = $this->createDeleteForm($article);
    $editForm = $this->createForm('Blog\Bundle\Form\ArticleType', $article);

    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($article);
      $em->flush();

      return $this->redirectToRoute('article_edit', array('id' => $article->getId()));
    }

    return $this->render('article/edit.html.twig', array(
      'article' => $article,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    ));
  }

  /**
  * Deletes a Article entity.
  *
  * @Route("/{id}", name="article_delete")
  * @Method("DELETE")
  */
  public function deleteAction(Request $request, Article $article)
  {
    $form = $this->createDeleteForm($article);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($article);
      $em->flush();
    }

    return $this->redirectToRoute('article_index');
  }

  /**
  * Creates a form to delete a Article entity.
  *
  * @param Article $article The Article entity
  *
  * @return \Symfony\Component\Form\Form The form
  */
  private function createDeleteForm(Article $article)
  {
    return $this->createFormBuilder()
    ->setAction($this->generateUrl('article_delete', array('id' => $article->getId())))
    ->setMethod('DELETE')
    ->getForm()
    ;
  }





}

<?php

namespace Blog\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Blog\Bundle\Entity\Commentaire;
use Blog\Bundle\Form\CommentaireType;
use Blog\Bundle\Entity\Article;


/**
* Commentaire controller.
*
* @Route("/commentaire")
*/
class CommentaireController extends Controller
{
  /**
  * Lists all Commentaire entities.
  *
  * @Route("/", name="commentaire_index")
  * @Method("GET")
  */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();

    $securityContext = $this->container->get('security.authorization_checker');
    if ($securityContext->isGranted('ROLE_ADMIN')) {
      $user = $this->getUser();
      $commentaires = $em->getRepository('BlogBundle:Commentaire')->findAll();
    }
    else{
      $user = $this->getUser();
      $commentaires = $em->getRepository('BlogBundle:Commentaire')->findBy(['user'=>$user]);
    }

    return $this->render('commentaire/index.html.twig', array(
      'commentaires' => $commentaires,
      'user' => $user,
    ));
  }

  /**
  * Creates a new Commentaire entity.
  *
  * @Route("/new", name="commentaire_new")
  * @Method({"GET", "POST"})
  */
  public function newAction(Request $request)
  {
    $commentaire = new Commentaire();
    $commentaire->setDate(new \DateTime('now'));
    $form = $this->createForm('Blog\Bundle\Form\CommentaireType', $commentaire);
    $form->handleRequest($request);

    $userId = $this->getUser();
    $userId->getId();
    $commentaire->setUser($userId);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($commentaire);
      $em->flush();

      return $this->redirectToRoute('commentaire_show', array('id' => $commentaire->getId()));
    }

    return $this->render('commentaire/new.html.twig', array(
      'commentaire' => $commentaire,
      'form' => $form->createView(),
    ));
  }

  /**
  * Finds and displays a Commentaire entity.
  *
  * @Route("/{id}", name="commentaire_show")
  * @Method("GET")
  */
  public function showAction(Commentaire $commentaire)
  {
    $deleteForm = $this->createDeleteForm($commentaire);

    return $this->render('commentaire/show.html.twig', array(
      'commentaire' => $commentaire,
      'delete_form' => $deleteForm->createView(),
    ));
  }


  /**
  * Displays a form to edit an existing Commentaire entity.
  *
  * @Route("/{id}/article/{articleId}/edit", name="commentaire_edit")
  * @Method({"GET", "POST"})
  */
  public function editAction(Request $request, Commentaire $commentaire , Article $articleId)
  {
    $deleteForm = $this->createDeleteForm($commentaire);
    $editForm = $this->createForm('Blog\Bundle\Form\CommentaireType', $commentaire);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($commentaire);
      $em->flush();

      return $this->redirectToRoute('article_show', array('id' => $articleId->getId()));
    }

    return $this->render('commentaire/edit.html.twig', array(
      'commentaire' => $commentaire,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    ));
  }


  /**
  * Deletes a Commentaire entity.
  *
  * @Route("/{id}", name="commentaire_delete")
  * @Method("DELETE")
  */
  public function deleteAction(Request $request, Commentaire $commentaire)
  {
    $form = $this->createDeleteForm($commentaire);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($commentaire);
      $em->flush();
    }
    return $this->redirectToRoute('accueil');

  }

  /**
  * Creates a form to delete a Commentaire entity.
  *
  * @param Commentaire $commentaire The Commentaire entity
  *
  * @return \Symfony\Component\Form\Form The form
  */
  private function createDeleteForm(Commentaire $commentaire)
  {
    return $this->createFormBuilder()
    ->setAction($this->generateUrl('commentaire_delete', array('id' => $commentaire->getId())))
    ->setMethod('DELETE')
    ->getForm()
    ;
  }



  /**
  * Lists tout les commentaires posté par l'utilisateur
  *
  * @Route("/postes/{id}", name="commentaire_postes")
  * @Method("GET")
  */
  public function postesAction()
  {
    $em = $this->getDoctrine()->getManager();
    $user = $this->getUser();
    $commentaires = $em->getRepository('BlogBundle:Commentaire')->findBy(['user'=>$user]);

    return $this->render('commentaire/index.html.twig', array(
      'commentaires' => $commentaires,
      'user' => $user,
    ));
  }


  /**
  * Lister tout les j'aimes posté par l'utilisateur
  *
  * @Route("/jaime/postes/{id}", name="jaime_postes")
  * @Method("GET")
  */
  public function jaimePostesAction()
  {
    $user = $this->getUser();
    $userId = $user->getId();
    $commentaires = $user->getCommentairelike();
    return $this->render('commentaire/index.html.twig', array(
      'commentaires' => $commentaires,
      'user' => $user,
    ));
  }


  /**
  * Supprime un commentaire depuis "commentaire"
  *
  * @Route("/{id}/suppression", name="commentaire_suppression")
  */
  public function commentaire_suppressionAction(Commentaire $commentaire)
  {
    if ($commentaire) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($commentaire);
      $em->flush();
    }
    return $this->redirectToRoute('commentaire_index');
  }

}

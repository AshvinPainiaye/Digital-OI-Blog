<?php

namespace Blog\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Blog\Bundle\Entity\Commentaire;
use Blog\Bundle\Form\CommentaireType;


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

    $commentaires = $em->getRepository('BlogBundle:Commentaire')->findAll();

    return $this->render('commentaire/index.html.twig', array(
      'commentaires' => $commentaires,
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
  * @Route("/{id}/edit", name="commentaire_edit")
  * @Method({"GET", "POST"})
  */
  public function editAction(Request $request, Commentaire $commentaire)
  {
    $deleteForm = $this->createDeleteForm($commentaire);
    $editForm = $this->createForm('Blog\Bundle\Form\CommentaireType', $commentaire);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($commentaire);
      $em->flush();

      return $this->redirectToRoute('commentaire_edit', array('id' => $commentaire->getId()));
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

    return $this->redirectToRoute('commentaire_index');
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



}

<?php
namespace Blog\Bundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ManageController extends Controller {

  /**
  * Lists all Article entities.
  *
  * @Route("/Manage", name="_manage")
  */
    public function ManageAction() {
            // Create em for entity user
            $usersRepository = $this->getDoctrine()
                    ->getRepository('BlogBundle:User');
            // Get all users from database
            $listeUsers = $usersRepository->findAll();
            // Return listeusers to view manage.html.twig
            return $this->render('manage/manage.html.twig', array(
                        'listeUsers' => $listeUsers
            ));
    }
    /**
    * Lists all Article entities.
    *
    * @Route("/Manage/{id}/edit", name="_edit")
    */
    public function EditAction($id, Request $request) {
        // Get our "authorization_checker" Object
        $auth_checker = $this->get('security.authorization_checker');
        // Check for Roles on the $auth_checker
        $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');
        // Test if user have ROLE_ADMIN
        if ($isRoleAdmin) {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('BlogBundle:User')->find($id);
            $editForm = $this->createFormBuilder($user)
                    ->add('username')
                    ->add('email')
                    ->add('roles', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                        'multiple' => true,
                        'expanded' => true,
                        'choices' => array(
                            'ADMIN' => 'ROLE_ADMIN',
                            'UTILISATEUR' => 'ROLE_UTILISATEUR',
                        ),
                    ))
                    ->getForm();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $em->flush();
                return $this->redirectToRoute('_manage');
            }
            $build['edit_form'] = $editForm->createView();
            return $this->render('manage/edit.html.twig', $build);
        }
    }
}

<?php

namespace Blastar\AdminUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Blastar\AdminUserBundle\Form\AdminType;
use Blastar\AdminUserBundle\Entity\User;

class AdminsController extends Controller
{

	public function indexAction()
	{
		if (false == $this->get('security.context')->isGranted('USERS_LIST')) {
			return new RedirectResponse($this->get('router')->generate('blastar_admin_user_homepage'));
		}

		$em = $this->getDoctrine()->getManager();

		$list = $em->getRepository('BlastarAdminUserBundle:User')->findBy(array(), array('username' => 'desc'));

		return $this->render('BlastarAdminUserBundle:Admins:index.html.twig', array('list' => $list));
	}

	public function editAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		if ($id == 0) {
			$entity = new User();
		} else {
			$entity = $em->getRepository('BlastarAdminUserBundle:User')->find($id);
		}

		$form = $this->createForm(new AdminType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_user_manager_save', array('id' => $id)),
			'method' => 'POST',
		));


		return $this->render('BlastarAdminUserBundle:Admins:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function saveAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
		if ($id == 0) {
			$entity = new User();
		} else {
			$entity = $em->getRepository('BlastarAdminUserBundle:User')->find($id);
		}

		$form = $this->createForm(new AdminType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_user_manager_save', array('id' => $id)),
			'method' => 'POST',
		));

		$form->handleRequest($request);


		if ($form->isValid()) {
			$formData = $this->get('request')->request->get('admin_user_edit_form');
			if (isset($formData['passwordnew']) && trim($formData['passwordnew']) != '') {
				$encoderFactory = $this->get('security.encoder_factory');
				$encoder = $encoderFactory->getEncoder($entity);
				$entity->setSalt(uniqid().uniqid());
				$password = $encoder->encodePassword($formData['passwordnew'], $entity->getSalt());
				$entity->setPassword($password);
			}

			$em->persist($entity);
			$em->flush();
			return new RedirectResponse($this->get('router')->generate('blastar_admin_user_manager_edit', array('id' => $id)));
		}
		foreach ($form->getErrors() as $key => $error) {
			$errors[] = $error->getMessage();
		}

		return $this->render('BlastarAdminUserBundle:Admins:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

}
<?php

namespace Blastar\AdminCategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Blastar\AdminCategoryBundle\Form\CategoryType;
use Blastar\AdminCategoryBundle\Entity\Category;

class CategoryController extends Controller
{

	public function indexAction()
	{
		if (false == $this->get('security.context')->isGranted('CATEGORIES_LIST')) {
			return new RedirectResponse($this->get('router')->generate('blastar_admin_user_homepage'));
		}

		$em = $this->getDoctrine()->getManager();

		$repo = $em->getRepository('BlastarAdminCategoryBundle:Category');
		$arrayTree = $repo->childrenHierarchy();

		return $this->render('BlastarAdminCategoryBundle:Category:index.html.twig', array('arrayTree' => $arrayTree));
	}

	public function editAction($id, $parentid)
	{
		$em = $this->getDoctrine()->getManager();

		if ($id == 0) {
			$entity = new Category();
		} else {
			$entity = $em->getRepository('BlastarAdminCategoryBundle:Category')->find($id);
		}

		$form = $this->createForm(new CategoryType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_category_save', array('id' => $id, 'parentid' => $parentid)),
			'method' => 'POST',
		));


		return $this->render('BlastarAdminCategoryBundle:Category:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function saveAction(Request $request, $id, $parentid)
	{
		$em = $this->getDoctrine()->getManager();
		if ($id == 0) {
			$entity = new Category();
			$em->persist($entity);
		} else {
			$entity = $em->getRepository('BlastarAdminCategoryBundle:Category')->find($id);
		}

		$form = $this->createForm(new CategoryType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_category_save', array('id' => $id)),
			'method' => 'POST',
		));

		$form->handleRequest($request);

		if ($form->isValid()) {

			if ($parentid > 0) {
				$parent = $em->getRepository('BlastarAdminCategoryBundle:Category')->find($parentid);
				$entity->setParent($parent);
			}

			
			$em->flush();
			return new RedirectResponse($this->get('router')->generate('blastar_admin_category_list', array()));
		}
		foreach ($form->getErrors() as $key => $error) {
			$errors[] = $error->getMessage();
		}

		return $this->render('BlastarAdminCategoryBundle:Category:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function removeAction($id)
	{

		$em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('BlastarAdminCategoryBundle:Category')->find($id);

		$em->remove($entity);
		$em->flush();

		return $this->redirect($this->generateUrl('blastar_admin_category_list'));
	}

}
<?php

namespace Blastar\AdminUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Blastar\AdminUserBundle\Form\CategoryType;
use Blastar\AdminUserBundle\Entity\Category;

class CmsController extends Controller
{

	public function indexAction()
	{
		if (false == $this->get('security.context')->isGranted('USERS_LIST')) {
			return new RedirectResponse($this->get('router')->generate('blastar_admin_user_homepage'));
		}

		$em = $this->getDoctrine()->getManager();

		$repo = $em->getRepository('BlastarAdminUserBundle:Category');
		$arrayTree = $repo->childrenHierarchy();


//		$catRoot = new Category();
//		$catRoot->setName('root cat');
//		$em->persist($catRoot);
//		
//		$catSub1 = new Category();
//		$catSub1->setName('sub 1');
//		$catSub1->setParent($catRoot);
//		$em->persist($catSub1);
//		
//		$catSub2 = new Category();
//		$catSub2->setName('sub 2');
//		$catSub2->setParent($catRoot);
//		$em->persist($catSub2);
//		
//		$catSub21 = new Category();
//		$catSub21->setName('sub 2.1');
//		$catSub21->setParent($catSub2);
//		$em->persist($catSub21);
//		
//		$em->flush();





		return $this->render('BlastarAdminUserBundle:Cms:index.html.twig', array('arrayTree' => $arrayTree));
	}

	public function editAction($id, $parentid)
	{
		$em = $this->getDoctrine()->getManager();

		if ($id == 0) {
			$entity = new Category();
		} else {
			$entity = $em->getRepository('BlastarAdminUserBundle:Category')->find($id);
		}

		$form = $this->createForm(new CategoryType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_cms_save', array('id' => $id, 'parentid' => $parentid)),
			'method' => 'POST',
		));


		return $this->render('BlastarAdminUserBundle:Cms:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function saveAction(Request $request, $id, $parentid)
	{
		$em = $this->getDoctrine()->getManager();
		if ($id == 0) {
			$entity = new Category();
		} else {
			$entity = $em->getRepository('BlastarAdminUserBundle:Category')->find($id);
		}

		$form = $this->createForm(new CategoryType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_cms_save', array('id' => $id)),
			'method' => 'POST',
		));

		$form->handleRequest($request);

		if ($form->isValid()) {

			if ($parentid > 0) {
				$parent = $em->getRepository('BlastarAdminUserBundle:Category')->find($parentid);
				$entity->setParent($parent);
			}

			$em->persist($entity);
			$em->flush();
			return new RedirectResponse($this->get('router')->generate('blastar_admin_cms_list', array()));
		}
		foreach ($form->getErrors() as $key => $error) {
			$errors[] = $error->getMessage();
		}

		return $this->render('BlastarAdminUserBundle:Cms:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function removeAction($id)
	{

		$em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('BlastarAdminUserBundle:Category')->find($id);

		$em->remove($entity);
		$em->flush();

		return $this->redirect($this->generateUrl('blastar_admin_cms_list'));
	}

}
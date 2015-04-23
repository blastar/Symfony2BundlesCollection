<?php

namespace Blastar\AdminNewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blastar\AdminNewsBundle\Entity\News;
use Blastar\AdminNewsBundle\Form\NewsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class NewsController extends Controller
{

	public function indexAction()
	{
		if (false == $this->get('security.context')->isGranted('NEWS_LIST')) {
			return new RedirectResponse($this->get('router')->generate('blastar_admin_user_homepage'));
		}

		$em = $this->getDoctrine()->getManager();

		$list = $em->getRepository('BlastarAdminNewsBundle:News')->findBy(array(), array('id' => 'desc'));

		return $this->render('BlastarAdminNewsBundle:News:index.html.twig', array('list' => $list));
	}

	public function editAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		if ($id == 0) {
			$entity = new News();
		} else {
			$entity = $em->getRepository('BlastarAdminNewsBundle:News')->find($id);
		}

		$form = $this->createForm(new NewsType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_news_save', array('id' => $id)),
			'method' => 'POST',
		));


		return $this->render('BlastarAdminNewsBundle:News:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function saveAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
		if ($id == 0) {
			$entity = new News();
			$entity->setCreatedAt(new \DateTime());
			$em->persist($entity);
		} else {
			$entity = $em->getRepository('BlastarAdminNewsBundle:News')->find($id);
		}

		$form = $this->createForm(new NewsType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_news_save', array('id' => $id)),
			'method' => 'POST',
		));

		$form->handleRequest($request);


		if ($form->isValid()) {
			$entity->setModifiedAt(new \DateTime());
			$em->flush();
			return new RedirectResponse($this->get('router')->generate('blastar_admin_news_edit', array('id' => $entity->getId())));
		}
		foreach ($form->getErrors() as $key => $error) {
			$errors[] = $error->getMessage();
		}

		return $this->render('BlastarAdminNewsBundle:News:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function removeAction($id)
	{

		$em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('BlastarAdminNewsBundle:News')->find($id);

		$em->remove($entity);
		$em->flush();

		return $this->redirect($this->generateUrl('blastar_admin_news_list'));
	}

}
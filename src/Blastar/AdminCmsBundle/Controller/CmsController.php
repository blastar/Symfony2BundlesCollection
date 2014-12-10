<?php

namespace Blastar\AdminCmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Blastar\AdminCmsBundle\Form\CmsType;
use Blastar\AdminCmsBundle\Entity\Cms;

class CmsController extends Controller
{

	public function indexAction()
	{
		if (false == $this->get('security.context')->isGranted('CMS_LIST')) {
			return new RedirectResponse($this->get('router')->generate('blastar_admin_user_homepage'));
		}

		$em = $this->getDoctrine()->getManager();

		$list = $em->getRepository('BlastarAdminCmsBundle:Cms')->findBy(array(), array('name' => 'desc'));

		return $this->render('BlastarAdminCmsBundle:Cms:index.html.twig', array('list' => $list));
	}

	public function editAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		if ($id == 0) {
			$entity = new Cms();
		} else {
			$entity = $em->getRepository('BlastarAdminCmsBundle:Cms')->find($id);
		}

		$form = $this->createForm(new CmsType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_cms_save', array('id' => $id)),
			'method' => 'POST',
		));


		return $this->render('BlastarAdminCmsBundle:Cms:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function saveAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
		if ($id == 0) {
			$entity = new Cms();
			$entity->setCreatedAt(new \DateTime());
		} else {
			$entity = $em->getRepository('BlastarAdminCmsBundle:Cms')->find($id);
		}

		$form = $this->createForm(new CmsType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_cms_save', array('id' => $id)),
			'method' => 'POST',
		));

		$form->handleRequest($request);


		if ($form->isValid()) {
			$entity->setModifiedAt(new \DateTime());
			$em->persist($entity);
			$em->flush();
			return new RedirectResponse($this->get('router')->generate('blastar_admin_cms_edit', array('id' => $entity->getId())));
		}
		foreach ($form->getErrors() as $key => $error) {
			$errors[] = $error->getMessage();
		}

		return $this->render('BlastarAdminCmsBundle:Cms:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}	
}

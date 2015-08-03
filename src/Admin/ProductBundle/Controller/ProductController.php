<?php

namespace Admin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Blastar\AdminCmsBundle\Form\CmsType;
use Blastar\AdminCmsBundle\Entity\Cms;

class ProductController extends Controller
{
    public function indexAction()
	{
		if (false == $this->get('security.context')->isGranted('PRODUCT_LIST')) {
			return new RedirectResponse($this->get('router')->generate('blastar_admin_user_homepage'));
		}

		$em = $this->getDoctrine()->getManager();

		$list = $em->getRepository('AdminProductBundle:Product')->findBy(array(), array('name' => 'desc'));

		return $this->render('AdminProductBundle:Product:index.html.twig', array('list' => $list));
	}

	public function editAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		if ($id == 0) {
			$entity = new Cms();
		} else {
			$entity = $em->getRepository('AdminProductBundle:Product')->find($id);
		}

		$form = $this->createForm(new CmsType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_product_save', array('id' => $id)),
			'method' => 'POST',
		));


		return $this->render('AdminProductBundle:Product:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function saveAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();
		if ($id == 0) {
			$entity = new Cms();
			$entity->setCreatedAt(new \DateTime());
			$em->persist($entity);
		} else {
			$entity = $em->getRepository('AdminProductBundle:Product')->find($id);
		}

		$form = $this->createForm(new CmsType(), $entity, array(
			'action' => $this->generateUrl('blastar_admin_product_save', array('id' => $id)),
			'method' => 'POST',
		));

		$form->handleRequest($request);


		if ($form->isValid()) {
			$entity->setModifiedAt(new \DateTime());
			$em->flush();
			return new RedirectResponse($this->get('router')->generate('blastar_admin_product_edit', array('id' => $entity->getId())));
		}
		foreach ($form->getErrors() as $key => $error) {
			$errors[] = $error->getMessage();
		}

		return $this->render('AdminProductBundle:Product:edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
	}

	public function removeAction($id)
	{

		$em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('AdminProductBundle:Product')->find($id);

		$em->remove($entity);
		$em->flush();

		return $this->redirect($this->generateUrl('blastar_admin_product_list'));
	}
}

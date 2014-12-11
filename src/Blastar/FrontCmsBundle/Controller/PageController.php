<?php

namespace Blastar\FrontCmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{

	public function indexAction($link)
	{
		$em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('BlastarAdminCmsBundle:Cms')->findOneBy(array('url' => $link));
		if (!$entity) {
			throw $this->createNotFoundException('The page does not exist');
		}
		return $this->render('BlastarFrontCmsBundle:Page:index.html.twig', array('page'=>$entity));
	}

}
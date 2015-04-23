<?php

namespace Blastar\FrontNewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsController extends Controller
{
    	public function indexAction($link)
	{
		$em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('BlastarAdminNewsBundle:News')->findOneBy(array('url' => $link));
		if (!$entity) {
			throw $this->createNotFoundException('The news does not exist');
		}
		return $this->render('BlastarFrontNewsBundle:News:index.html.twig', array('news'=>$entity));
	}
}

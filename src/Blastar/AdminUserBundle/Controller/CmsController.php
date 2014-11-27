<?php

namespace Blastar\AdminUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Blastar\AdminUserBundle\Form\AdminType;
use Blastar\AdminUserBundle\Entity\Category;

class CmsController extends Controller
{

	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();
		
		$repo = $em->getRepository('BlastarAdminUserBundle:Category');
$arrayTree = $repo->childrenHierarchy();
$htmlTree = $repo->childrenHierarchy(
    null, /* starting from root nodes */
    false, /* true: load all children, false: only direct */
    array(
        'decorate' => true,
        'representationField' => 'slug',
        'html' => true
    )
);
echo $htmlTree;
exit;
		
		$catRoot = new Category();
		$catRoot->setName('root cat');
		$em->persist($catRoot);
		
		$catSub1 = new Category();
		$catSub1->setName('sub 1');
		$catSub1->setParent($catRoot);
		$em->persist($catSub1);
		
		$catSub2 = new Category();
		$catSub2->setName('sub 2');
		$catSub2->setParent($catRoot);
		$em->persist($catSub2);
		
		$catSub21 = new Category();
		$catSub21->setName('sub 2.1');
		$catSub21->setParent($catSub2);
		$em->persist($catSub21);
		
		$em->flush();
		
		echo '<pre>';
		\Doctrine\Common\Util\Debug::dump('ss');
		exit;
		
		if (false == $this->get('security.context')->isGranted('USERS_LIST')) {
			return new RedirectResponse($this->get('router')->generate('blastar_admin_user_homepage'));
		}


		$list = $em->getRepository('BlastarAdminUserBundle:User')->findBy(array(), array('username' => 'desc'));

		return $this->render('BlastarAdminUserBundle:Cms:index.html.twig', array('list' => $list));
	}


}
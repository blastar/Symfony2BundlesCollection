<?php
namespace Blastar\AdminUserBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\KernelEvents;

class TwigListener extends ContainerAware implements EventSubscriberInterface
{

	/**
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return array(KernelEvents::CONTROLLER => array(
				array('doTwig', 0), // 0 is just the priority
		));
	}

	/**
	 * @param FilterControllerEvent $event
	 */
	public function doTwig(FilterControllerEvent $event)
	{
		// Ignore sub requests
		if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
			return;
		}

		/*$itemsManager = $this->container->get('enp_order.manager.group_items');*/
		/* @var $itemsManager CartItemsManager */

		$globalCart = array(
		);

		$this->container->get('twig')->addGlobal('globalCart', $globalCart);
	}

}
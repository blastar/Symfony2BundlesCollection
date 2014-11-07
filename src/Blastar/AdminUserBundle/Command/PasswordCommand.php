<?php

namespace Blastar\AdminUserBundle\Command;

use Doctrine\ORM\EntityManager;
use Exception;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PasswordCommand extends ContainerAwareCommand
{

	protected function configure()
	{
		$this->setName('user:password');
		$this->setDescription('user password');
		$this->addArgument('userid', InputArgument::REQUIRED, 'User ID');
		$this->addArgument('password', InputArgument::REQUIRED, 'New password');
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$userid = $input->getArgument('userid');
		$password = $input->getArgument('password');
		$output->writeln(sprintf("Setting password %s for user %s", $password, $userid));

		$em = $this->getContainer()->get('doctrine.orm.entity_manager');
		/* @var $em EntityManager */

		$entity = $em->getRepository('BlastarAdminUserBundle:User')->find($userid);
		$entity->setSalt(uniqid().uniqid());

		$factory = $this->getContainer()->get('security.encoder_factory');
		$encoder = $factory->getEncoder($entity);
		$password = $encoder->encodePassword($password, $entity->getSalt());

		$entity->setPassword($password);

		$em->persist($entity);
		$em->flush();

		$output->writeln("Password set");
	}

}
<?php

namespace Blastar\AdminUserBundle\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of SecurityVoter
 *
 * @author kdeneka
 */
class SecurityVoter implements VoterInterface
{

	public function supportsAttribute($attribute)
	{
		return true;
	}

	public function supportsClass($class)
	{
		return true;
	}

	/**
	 * @var \Acme\DemoBundle\Entity\Post $post
	 */
	public function vote(TokenInterface $token, $post, array $attributes)
	{
		$user = $token->getUser();

		if (!$user instanceof UserInterface) {
			return VoterInterface::ACCESS_DENIED;
		}

		$attribute = $attributes[0];
		if ($attribute == 'ROLE_ADMIN') {
			return self::ACCESS_GRANTED;
		}

		$acls = $user->getAcl();
		foreach ($acls as $acl) {
			if ($acl->getIdent() == $attribute) {
				return self::ACCESS_GRANTED;
			}
		}

		return self::ACCESS_DENIED;
	}

}
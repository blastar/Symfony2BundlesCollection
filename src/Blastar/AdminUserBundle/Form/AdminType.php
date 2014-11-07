<?php

namespace Blastar\AdminUserBundle\Form;

use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdminType extends AbstractType
{

	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
				->add('username', 'text', array(
					'required' => true,
					'label' => 'username'
				))
				->add('email', 'text', array(
					'required' => true,
					'label' => 'email'
				))
				->add('passwordnew', 'text', array(
					'required' => false,
					'mapped' => false,
					'label' => 'password'
				))
				->add('isActive', 'checkbox', array(
					'label' => 'is active',
					'value' => 1,
				))
				->add('acl', 'entity', array(
					'required' => true,
					'multiple' => true,
					'expanded' => false,
					'property' => 'name',
					'class' => 'Blastar\AdminUserBundle\Entity\Role',
					'label' => 'roles'
				))				
				->add('save', 'submit', array('label' => 'save'))
		;
	}

	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Blastar\AdminUserBundle\Entity\User',
		))
		;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'admin_user_edit_form';
	}

}
<?php

namespace Blastar\AdminUserBundle\Form;

use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{

	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
				->add('name', 'text', array(
					'required' => true,
					'label' => 'name'
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
			'data_class' => 'Blastar\AdminUserBundle\Entity\Category',
		))
		;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'admin_category_edit_form';
	}

}
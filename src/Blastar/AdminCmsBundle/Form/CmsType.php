<?php

namespace Blastar\AdminCmsBundle\Form;

use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CmsType extends AbstractType
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
				->add('content', 'textarea', array(
					'required' => true,
					'label' => 'content'
				))			
				->add('url', 'text', array(
					'required' => true,
					'label' => 'url'
				))			
				->add('is_enabled', 'checkbox', array(
					'required' => false,
					'label' => 'enabled'
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
			'data_class' => 'Blastar\AdminCmsBundle\Entity\Cms',
		))
		;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'admin_cms_edit_form';
	}

}
<?php

namespace Blastar\AdminNewsBundle\Form;

use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{

	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
				->add('title', 'text', array(
					'required' => true,
					'label' => 'title'
				))			
				->add('header', 'textarea', array(
					'required' => false,
					'label' => 'header'
				))			
				->add('content', 'textarea', array(
					'required' => false,
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
			'data_class' => 'Blastar\AdminNewsBundle\Entity\News',
		))
		;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'admin_news_edit_form';
	}

}
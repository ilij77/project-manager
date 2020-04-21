<?php

declare(strict_types=1);
namespace App\Model\Comment\UseCase\Comment\Edit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class Form extends AbstractType

{


	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('text',Type\TextareaType::class,['label'=>'Comment','attr'=>['rows'=>6]]);




	}
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class'=>Command::class,
		));
	}
	public function getBlockPrefix()
	{
		return 'comment';
	}

}
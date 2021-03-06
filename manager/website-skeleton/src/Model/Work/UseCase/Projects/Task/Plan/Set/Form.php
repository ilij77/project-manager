<?php

declare(strict_types=1);
namespace App\Model\Work\UseCase\Projects\Task\Plan\Set;



use App\Model\Work\Entity\Projects\Task\Type as TaskType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class Form extends AbstractType

{


	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('date',Type\DateType::class,['widget'=>'single_text','input'=>'datetime_immutable']);


	}
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class'=>Command::class,
		));
	}

}
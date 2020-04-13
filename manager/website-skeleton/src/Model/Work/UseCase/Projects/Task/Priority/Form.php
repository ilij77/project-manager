<?php

declare(strict_types=1);
namespace App\Model\Work\UseCase\Projects\Task\Priority;



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

			->add('priority',Type\ChoiceType::class,[
				'choices'=>[
					'Low'=>1,
					'Normal'=>2,
					'High'=>3,
					'Extra'=>4,
					]]);



	}
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class'=>Command::class,
		));
	}
	public function getBlockPrefix()
	{
		return 'priority';
	}

}
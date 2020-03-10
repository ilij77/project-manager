<?php


namespace App\Model\User\UseCase\Edit;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('firstName',Type\TextType::class,['label'=>'First Name'])
			->add('lasttName',Type\TextType::class,['label'=>'Last Name'])
			->add('email',Type\EmailType::class,['label'=>'Email']);

	}
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class'=>Command::class,
		));
	}

}
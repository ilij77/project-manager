<?php


namespace App\Model\Work\UseCase\Members\Member\Create;


use App\ReadModel\Work\Members\GroupFetcher;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class Form extends AbstractType

{

	private $groups;

	public function __construct(GroupFetcher $groups)
	{

		$this->groups = $groups;
	}
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('group',Type\ChoiceType::class,['choices'=>array_flip($this->groups->assoc())])
			->add('firstName',Type\TextType::class)
			->add('lastName',Type\TextType::class)
			->add('email',Type\EmailType::class);


	}
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class'=>Command::class,
		));
	}

}
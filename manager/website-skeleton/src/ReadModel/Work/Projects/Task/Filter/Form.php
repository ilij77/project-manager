<?php
declare(strict_types=1);

namespace App\ReadModel\Work\Projects\Task\Filter;



use App\Model\Work\Entity\Projects\Task\Status;

use App\ReadModel\Work\Members\Member\MemberFetcher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type;
use App\Model\Work\Entity\Projects\Task\Type as TaskType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{


	private $members;

	public function __construct(MemberFetcher $members)
	{

		$this->members = $members;
	}
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$executors=[];
		foreach ($this->members->activeGroupList()as $item){
			$executors[$item['group']][$item['name']]=$item['id'];
		}
		$builder
			->add('name', Type\TextType::class, ['required' => false, 'attr' => [
				'placeholder' => 'Search.....',
				'onchange' => 'this.form.submit()',
			]])
			->add('type', Type\ChoiceType::class, ['choices' => [
				'None' => TaskType::NONE,
				'Error' => TaskType::ERROR,
				'Feature' => TaskType::FEATURE,
				], 'required' => false, 'placeholder' => 'All types', 'attr' => ['onchange' => 'this.form.submit()']])
			->add('status', Type\ChoiceType::class, ['choices' => [
				'New' => Status::NEW,
				'Working' => Status::WORKING,
				'Need Help' => Status::HELP,
				'Checking' => Status::CHECKING,
				'Rejected' => Status::REJECTED,
				'Done' => Status::DONE,
			], 'required' => false, 'placeholder' => 'All status', 'attr' => ['onchange' => 'this.form.submit()']])
			->add('priority', Type\ChoiceType::class, ['choices' => [
				'Low' => 1,
				'Normal' => 2,
				'Hight' => 3,
				'Extra' => 4,

			], 'required' => false, 'placeholder' => 'All priorities', 'attr' => ['onchange' => 'this.form.submit()']])
			->add('executor', Type\ChoiceType::class, [
				'choices' => $executors,
				'required' => false,
				'placeholder' => 'All executors',
				'attr' => ['onchange' => 'this.form.submit()']
			]);
	}
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class'=>Filter::class,
			'method'=>'GET',
			'csrf_protection'=>false,
		]);
	}

}
<?php
declare(strict_types=1);
namespace App\Model\Work\UseCase\Projects\Task\Status;
use App\Model\Work\Entity\Projects\Task\Task;use App\Model\Work\Entity\Projects\Task\Type;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{

	/**
	 * @Assert\NotBlank()
	 */
	public $id;

	/**
	 * @Assert\NotBlank()
	 */
	public $status;



	public function __construct(int $id)
	{

		$this->id=$id;
	}

	public static function fromTask(Task $task):self
	{
		$command=new self($task->getId()->getValue());
		$command->status=$task->getStatus()->getName();
		return $command;

	}






}
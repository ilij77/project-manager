<?php
declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Start;


use App\Model\Flusher;

use App\Model\Work\Entity\Projects\Task\Id;
use App\Model\Work\Entity\Projects\Task\Task;
use App\Model\Work\Entity\Projects\Task\TaskRepository;
use App\Model\Work\Entity\Projects\Task\Type;


class Handler
{




	private $tasks;
	private $flusher;

	public function __construct(TaskRepository $tasks,Flusher $flusher)
	{



		$this->flusher = $flusher;


		$this->tasks = $tasks;
	}

	public function handle(Command $command):void
	{
		$task=$this->tasks->get(new Id($command->id));
		$task->start(new \DateTimeImmutable());
		$this->flusher->flush();

	}

}
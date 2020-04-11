<?php
declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Task\Executor\Remove;


use App\Model\Flusher;

use App\Model\Work\Entity\Members\Member\MemberRepository;
use App\Model\Work\Entity\Projects\Task\Id;
use App\Model\Work\Entity\Projects\Task\Task;
use App\Model\Work\Entity\Projects\Task\TaskRepository;
use App\Model\Work\Entity\Members\Member\Id as MemberId;


class Handler
{
	private $tasks;
	private $flusher;

	private $members;

	public function __construct(TaskRepository $tasks,MemberRepository $members,Flusher $flusher)
	{



		$this->flusher = $flusher;


		$this->tasks = $tasks;
		$this->members = $members;
	}

	public function handle(Command $command):void
	{
		$task=$this->tasks->get(new Id($command->id));

		$member=$this->members->get(new MemberId($command->member));
		$task->revokeExecutor($member->getId());


		$this->flusher->flush();

	}

}
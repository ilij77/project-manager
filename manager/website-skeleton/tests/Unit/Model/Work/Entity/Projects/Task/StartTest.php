<?php

declare(strict_types=1);
namespace App\Tests\Unit\Model\Work\Entity\Projercts\Task;


use App\Tests\Builder\Work\Members\GroupBuilder;
use App\Tests\Builder\Work\Members\MemberBuilder;
use App\Tests\Builder\Work\Projects\ProjectBuilder;
use App\Tests\Builder\Work\Projects\TaskBuilder;
use PHPUnit\Framework\TestCase;

class StartTest extends  TestCase
{
	public function testSuccess():void
	{
		$group=(new GroupBuilder())->build();
		$member=(new MemberBuilder())->build($group);
		$project=(new ProjectBuilder())->build();
		$task=(new TaskBuilder())->build($project,$member);
		$executor=(new MemberBuilder())->build($group);
		$task->assignExecutor($executor);
		$task->start($date=new \DateTimeImmutable('+2 day'));

		self::assertEquals($date,$task->getStartDate());
		self::assertTrue($task->isWorking());


	}
	public function testAlready():void
	{
		$group=(new GroupBuilder())->build();
		$member=(new MemberBuilder())->build($group);
		$project=(new ProjectBuilder())->build();
		$task=(new TaskBuilder())->build($project,$member);

		$executor=(new MemberBuilder())->build($group);
		$task->assignExecutor($executor);
		$task->start($date=new \DateTimeImmutable());

		$this->expectExceptionMessage('Task is already started.');
		$task->start($date=new \DateTimeImmutable());

	}
	public function testWithoutExecutors():void
	{
		$group=(new GroupBuilder())->build();
		$member=(new MemberBuilder())->build($group);
		$project=(new ProjectBuilder())->build();
		$task=(new TaskBuilder())->build($project,$member);



		$this->expectExceptionMessage('Task does not contain executors.');
		$task->start($date=new \DateTimeImmutable());

	}

}
<?php
declare(strict_types=1);

namespace App\Tests\Unit\Model\Work\Entity\Projercts\Task;


use App\Model\Work\Entity\Projects\Task\Status;
use App\Model\Work\Entity\Projects\Task\Type;
use App\Tests\Builder\Work\Members\GroupBuilder;
use App\Tests\Builder\Work\Members\MemberBuilder;
use App\Tests\Builder\Work\Projects\ProjectBuilder;
use App\Tests\Builder\Work\Projects\TaskBuilder;
use PHPUnit\Framework\TestCase;

class ChangeStatusTest extends TestCase
{
	public function testSuccess():void
	{
		$group=(new GroupBuilder())->build();
		$member=(new MemberBuilder())->build($group);
		$project=(new ProjectBuilder())->build();
		$task=(new TaskBuilder())->build($project,$member);
		$task->changeStatus($status=new Status(Status::WORKING),$date=new \DateTimeImmutable());
		self::assertEquals($status,$task->getStatus());
		self::assertEquals($date,$task->getStartDate());
		self::assertNull($task->getEndDate());

	}
	public function testAlready():void
	{
		$group=(new GroupBuilder())->build();
		$member=(new MemberBuilder())->build($group);
		$project=(new ProjectBuilder())->build();
		$task=(new TaskBuilder())->build($project,$member);
		$task->changeStatus($status=new Status(Status::WORKING),$date=new \DateTimeImmutable());

		$this->expectExceptionMessage('Status is already same.');
		$task->changeStatus($status,$date);

	}
	public function testDonePriority():void
	{
		$group=(new GroupBuilder())->build();
		$member=(new MemberBuilder())->build($group);
		$project=(new ProjectBuilder())->build();
		$task=(new TaskBuilder())->build($project,$member);
		$task->changeStatus($status=new Status(Status::DONE),$date=new \DateTimeImmutable());

		self::assertEquals($status,$task->getStatus());
		self::assertEquals(100,$task->getProgress());

	}

	public function testStartDate():void
	{
		$group=(new GroupBuilder())->build();
		$member=(new MemberBuilder())->build($group);
		$project=(new ProjectBuilder())->build();
		$task=(new TaskBuilder())->build($project,$member);
		$task->changeStatus($status=new Status(Status::WORKING),$date=new \DateTimeImmutable('+1 day'));

		self::assertEquals($date,$task->getStartDate());
		self::assertNull($task->getEndDate());

	}
	public function testEndtDateWithStartDate():void
	{
		$group=(new GroupBuilder())->build();
		$member=(new MemberBuilder())->build($group);
		$project=(new ProjectBuilder())->build();
		$task=(new TaskBuilder())->build($project,$member);
		$task->changeStatus($status=new Status(Status::WORKING),$startdate=new \DateTimeImmutable('+1 day'));

		$task->changeStatus(new Status(Status::DONE),$enddate=new \DateTimeImmutable('+1 day'));
		self::assertEquals($startdate,$task->getStartDate());
		self::assertEquals($enddate,$task->getEndDate());


	}

	public function testEndtDateWithoutStartDate():void
	{
		$group=(new GroupBuilder())->build();
		$member=(new MemberBuilder())->build($group);
		$project=(new ProjectBuilder())->build();
		$task=(new TaskBuilder())->build($project,$member);


		$task->changeStatus(new Status(Status::DONE),$enddate=new \DateTimeImmutable('+1 day'));
		$task->changeStatus(new Status(Status::WORKING),new \DateTimeImmutable('+2 day'));


		self::assertEquals($enddate,$task->getStartDate());
		self::assertNull($task->getEndDate());


	}


}
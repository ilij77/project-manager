<?php
declare(strict_types=1);

namespace App\Tests\Unit\Model\User\Entity\User\Reset;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\ResetToken;
use App\Model\User\Entity\User\User;
use App\Tests\Builder\User\UserBuilder;
use Monolog\Test\TestCase;

class RequestTest extends TestCase
{
	public function testSuccess():void
	{
		$now=new \DateTimeImmutable();
		$token=new ResetToken('token',$now->modify('+1 day'));
		$user=(new UserBuilder())->viaEmail()->build();
		$user->requestPasswordReset($token,$now);
		self::assertNotNull($user->getResetToken());

	}

	public function testAlready():void
	{
		$now=new \DateTimeImmutable();
		$token=new ResetToken('token',$now->modify('+1 day'));
		$user=(new UserBuilder())->viaEmail()->build();
		$user->requestPasswordReset($token,$now);
		$this->expectExceptionMessage('Resetting is already requested.');
		$user->requestPasswordReset($token,$now);

	}

	public function testExpired():void
	{
		$now=new \DateTimeImmutable();
		$token1=new ResetToken('token',$now->modify('+1 day'));
		$user=(new UserBuilder())->viaEmail()->build();
		$user->requestPasswordReset($token1,$now);
		self::assertEquals($token1,$user->getResetToken());

		$token2=new ResetToken('token',$now->modify('+3 day'));
		$user->requestPasswordReset($token2,$now->modify('+2 day'));
		self::assertEquals($token2,$user->getResetToken());

	}

	public function testWithoutEmail():void
	{
		$now=new \DateTimeImmutable();
		$token=new ResetToken('token',$now->modify('+1 day'));
		$user=(new UserBuilder())->viaNetwork()->build();
		$this->expectExceptionMessage('Email is not specified.');
		$user->requestPasswordReset($token,$now);

	}





}
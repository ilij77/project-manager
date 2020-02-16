<?php
namespace App\Test\Unit\Model\User\Entity\User\SignUp;

use PHPUnit\Framework\TestCase;
use App\Model\User\Entity\User\User;

class RequestTest extends TestCase
{
	public function testSuccess():void
	{
		$user=new User(
			$email='test@app.test',
			$hash='hash'
		);

		self::assertEquals($email,$user->getEmail());
		self::assertEquals($hash,$user->getPasswordHash());

	}

}
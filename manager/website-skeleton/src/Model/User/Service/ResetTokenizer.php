<?php

declare(strict_types=1);

namespace App\Model\User\Service;

use App\Model\User\Entity\User\ResetToken;
use Ramsey\Uuid\Uuid;

class ResetTokenizer
{
	private $interval;

	public function __construct()
	{
		$this->interval = $interval=new \DateInterval('PT1H');
	}

	public function generate(): ResetToken
	{
		return new ResetToken(
			Uuid::uuid4()->toString(),
			(new \DateTimeImmutable())->add($this->interval)
		);
	}
}
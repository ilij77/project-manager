<?php
declare(strict_types=1);

namespace App\Container\Model\User\Service;

use App\Model\User\Service\ResetTokenizer;

class ResetTokenizerFactory
{
	public function create(string $int):ResetTokenizer
	{
		return new ResetTokenizer(new \DateInterval('PT1H'));

	}

}
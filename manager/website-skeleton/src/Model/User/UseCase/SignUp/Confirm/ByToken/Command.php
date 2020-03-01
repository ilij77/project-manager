<?php
declare(strict_types=1);
namespace App\Model\User\UseCase\SignUp\Confirm\ByToken;

class Command
{
	/**
	 * @var string
	 */
	public $token;

	public function __construct($token)
	{

		$this->token = $token;
	}

}
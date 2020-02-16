<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

class User
{
	/**
	 * @var string
	 */
	private $email;
	/**
	 * @var string
	 */
	private $passwordHash;
	/**
	 * @var string
	 */
	private $hash;

	public function __construct(string $email,string $hash)
	{

		$this->email = $email;
		$this->passwordHash = $hash;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function getPasswordHash(): string
	{
		return $this->passwordHash;
	}

}
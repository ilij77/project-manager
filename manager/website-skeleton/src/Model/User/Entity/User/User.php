<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

class User
{

	private const STATUS_WAIT='wait';
	private const STATUS_ACTIVE='active';
	/**
	 * @var Id
	 */
	private $id;
	/**
	 * @var \DateTimeImmutable
	 */
	private $data;
	/**
	 * @var Email
	 */
	private $email;
	/**
	 * @var string
	 */
	private $passwordHash;
	/**
	 * @var string|null
	 */
    private $confirmToken;
	/**
	 * @var string
	 */
    private $status;


	public function __construct(Id $id,\DateTimeImmutable $data,Email $email,string $hash,string $token)
	{

		$this->email = $email;
		$this->passwordHash = $hash;
		$this->id = $id;
		$this->data = $data;
		$this->confirmToken=$token;
		$this->status=self::STATUS_WAIT;
	}

	public function confirmSignUp():void
	{
		if (!$this->isWait()){
			throw new \DomainException('User is already confirmed.');
		}
		$this->status=self::STATUS_ACTIVE;
		$this->confirmToken=null;

	}
	public function isWait():bool
	{
		return $this->status===self::STATUS_WAIT;

	}
	public function isActive():bool
	{
		return $this->status===self::STATUS_ACTIVE;

	}

	public function getId(): Id
	{
		return $this->id;
	}

	public function getEmail(): Email
	{
		return $this->email;
	}

	/**
	 * @return \DateTimeImmutable
	 */
	public function getData(): \DateTimeImmutable
	{
		return $this->data;
	}


	public function getPasswordHash(): string
	{
		return $this->passwordHash;
	}

	public function getConfirmToken():?string
	{
		return $this->confirmToken;

	}

}

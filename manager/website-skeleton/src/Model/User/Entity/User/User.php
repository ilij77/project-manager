<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;

class User
{

	private const STATUS_NEW='new';
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
	 * @var Email|null
	 */
	private $email;
	/**
	 * @var string|null
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

	/**
	 * @var Network[]|ArrayCollection
	 */
	private $networks;

	/**
	 * @var ResetToken|null
	 */
	private $resetToken;
	/**
	 * @var Role
	 */
	private $rele;

	private function __construct(Id $id,\DateTimeImmutable $data)
	{


		$this->id = $id;
		$this->data = $data;
		$this->role=Role::user();
		$this->networks=new ArrayCollection();
	}

	public static function signUpByEmail(Id $id,\DateTimeImmutable $date,Email $email,string $hash,string $token):self
	{
		$user=new self($id,$date);

		$user->email=$email;
		$user->passwordHash=$hash;
		$user->confirmToken=$token;
		$user->status=self::STATUS_WAIT;
		return $user;

	}

	public function confirmSignUp():void
	{
		if (!$this->isWait()){
			throw new \DomainException('User is already confirmed.');
		}
		$this->status=self::STATUS_ACTIVE;
		$this->confirmToken=null;

	}

	public  static function signUpByNetwork(Id $id,\DateTimeImmutable $date,string $network,string $identity):self
	{
		$user=new self($id,$date);
		$user->attachNetwork($network,$identity);
		$user->status=self::STATUS_ACTIVE;
		return $user;


	}

	public function attachNetwork(string $network,string $identity):void
	{
		foreach ($this->networks as $existing){
			if ($existing->isForNetwork($network)){
				throw new \DomainException('Network is already attached.');
			}
		}
		$this->networks->add(new Network($this,$network,$identity));

	}

	public function requestPasswordReset(ResetToken $token, \DateTimeImmutable $date):void
	{
		if (!$this->isActive()){
			throw new \DomainException('User is not active.');
		}
		if (!$this->email){
			throw new \DomainException('Email is not specified.');
		}
		if ($this->resetToken&& !$this->resetToken->isExpiredTo($date)){
			throw new \DomainException('Resetting is already requested.');
		}
		$this->resetToken=$token;

	}

	public function passwordReset(\DateTimeImmutable $date,string $hash):void
	{
		if (!$this->resetToken){
			throw new \DomainException('Resetting is not requested.');
		}
		if ($this->resetToken->isExpiredTo($date)){
			throw new \DomainException('Reset token is expired.');
		}
		$this->passwordHash=$hash;
		$this->resetToken=null;

	}

	/**
	 * @return ResetToken|null
	 */
	public function getResetToken(): ?ResetToken
	{
		return $this->resetToken;
	}

	public function isNew():bool
	{
		return $this->status===self::STATUS_NEW;

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

	public function getEmail(): ?Email
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


	public function getPasswordHash(): ?string
	{
		return $this->passwordHash;
	}

	public function getConfirmToken():?string
	{
		return $this->confirmToken;

	}

	/**
	 * @return Network[]
	 */
	public function getNetworks():array
	{
		return $this->networks->toArray();
	}


	public function getRole(): Role
	{
		return $this->role;
	}

	public function changeRole(Role $role):void
	{
		if ($this->role->isEqual($role)){
			throw new \DomainException('Role is already same.');
		}
		$this->role=$role;

	}

}

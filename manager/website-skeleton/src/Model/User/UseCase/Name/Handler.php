<?php
declare(strict_types=1);

namespace App\Model\User\UseCase\Name;


use App\Model\Flusher;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\Name;
use App\Model\User\Entity\User\UserRepository;
use App\Model\User\Service\NewEmailConfirmTokenizer;
use App\Model\User\Service\NewEmailConfirmTokenSender;

class Handler
{
	/**
	 * @var UserRepository
	 */
	private $users;
	/**
	 * @var NewEmailConfirmTokenizer
	 */
	private $tokenizer;
	/**
	 * @var NewEmailConfirmTokenSender
	 */
	private $sender;
	/**
	 * @var Flusher
	 */
	private $flusher;

	public function __construct(
		UserRepository $users,
	NewEmailConfirmTokenizer $tokenizer,
	NewEmailConfirmTokenSender $sender,
	Flusher $flusher
	)
	{

		$this->users = $users;
		$this->tokenizer = $tokenizer;
		$this->sender = $sender;
		$this->flusher = $flusher;
	}

	public function handle(Command $command):void
	{
		$user=$this->users->get(new Id($command->id));
		$user->changeName(new Name(
			$command->firstName,
			$command->lastName
		));
		$this->flusher->flush();

	}

}
<?php
declare(strict_types=1);

namespace App\Model\Work\UseCase\Projects\Role\Remove;


use App\Model\Flusher;

use App\Model\Work\Entity\Projects\Role\Id;
use App\Model\Work\Entity\Projects\Role\RoleRepository;


class Handler
{

	private $roles;

	private $flusher;

	public function __construct(RoleRepository $roles, Flusher $flusher)
	{

		$this->roles = $roles;
		$this->flusher = $flusher;
	}

	public function handle(Command $command)
	{
		$role=$this->roles->get(new Id($command->id));
		$this->roles->remove($role);
		$this->flusher->flush();

	}

}
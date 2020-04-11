<?php
declare(strict_types=1);
namespace App\Model\Work\UseCase\Projects\Task\Plan\Remove;
use App\Model\Work\Entity\Projects\Task\Task;use App\Model\Work\Entity\Projects\Task\Type;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{

	/**
	 * @Assert\NotBlank()
	 */
	public $id;




	public function __construct(int $id)
	{

		$this->id=$id;
	}


}
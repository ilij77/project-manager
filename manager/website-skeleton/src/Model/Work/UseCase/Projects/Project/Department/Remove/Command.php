<?php
declare(strict_types=1);
namespace App\Model\Work\UseCase\Projects\Project\Department\Remove;
use Symfony\Component\Validator\Constraints as Assert;
class Command
{
	/**
	* @Assert\NotBlank()
	 */
	public $id;
	/**
	 * @Assert\NotBlank()
	 */
	public $project;
	public function __construct(string $project,string $id)
	{

		$this->id = $id;
		$this->project = $project;
	}

}
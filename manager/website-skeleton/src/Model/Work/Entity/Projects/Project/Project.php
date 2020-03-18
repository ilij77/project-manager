<?php
declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Project;
use App\Model\Work\Entity\Members\Member\Status;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="work_projects_projects")
 */
class Project
{
	/**
	 * @var Id
	 * @ORM\Column(type="work_projects_project_id")
	 * @ORM\Id()
	 */
	private $id;
	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	private $name;

	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	private $sort;

	/**
	 * @var Status
	 * @ORM\Column(type="work_projects_project_status",length=16)
	 */
	private $status;

	public function __construct(Id $id,string $name,int $sort)
	{

		$this->id = $id;
		$this->name = $name;
		$this->sort = $sort;
		$this->status=Status::active();
	}

	public function edit(string $name,int $sort):void
	{
		$this->name=$name;
		$this->sort=$sort;

	}

	public function archive():void
	{
		if ($this->status->isArchived()){
			throw new \DomainException('Member is already archived.');
		}
		$this->status=Status::archived();

	}
	public function reinstate():void
	{
		if ($this->status->isActive()){
			throw new \DomainException('Member is already active.');
		}
		$this->status=Status::active();

	}

	public function isActive():bool
	{
		return $this->status->isActive();

	}

	public function isArchived():bool
	{
		return $this->status->isArchived();

	}


	public function getSort(): int
	{
		return $this->sort;
	}
	public function getId(): Id
	{
		return $this->id;
	}
	public function getName(): string
	{
		return $this->name;
	}

	public function getStatus(): Status
	{
		return $this->status;
	}

}
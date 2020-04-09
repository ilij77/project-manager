<?php


namespace App\Model\Work\UseCase\Projects\Project\Membership\Add;


use App\Model\Flusher;


use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Members\Member\MemberRepository;

use App\Model\Work\Entity\Projects\Project\Department\Department;
use App\Model\Work\Entity\Projects\Project\Id;
use App\Model\Work\Entity\Projects\Project\ProjectRepository;
use App\Model\Work\Entity\Projects\Role\Role;
use App\Model\Work\Entity\Projects\Role\RoleRepository;
use App\Model\Work\Entity\Members\Member\Id as MemberId;
use App\Model\Work\Entity\Projects\Project\Department\Id as DepartmentID;
use App\Model\Work\Entity\Projects\Role\Id as RoleID;


class Handler
{

	private $projects;
	private $flusher;

	private $members;

	private $roles;

	public function __construct(
		ProjectRepository $projects,
		MemberRepository $members,
		RoleRepository $roles,
		Flusher $flusher
	)
	{

		$this->projects = $projects;

		$this->flusher = $flusher;

		$this->members = $members;
		$this->roles = $roles;
	}

	public function handle(Command $command):void
	{
		$project=$this->projects->get(new Id($command->project));
		$member=$this->members->get(new MemberId($command->member));
		$departments=array_map(static function(string $id):DepartmentID{
			return new DepartmentID($id);
		},$command->departments);
		$roles=array_map(static function(string $id):RoleID{
			return $this->roles->get(new RoleID($id));
		},$command->roles);

		$project->addMember($member,$departments,$roles);

		$this->flusher->flush();

	}

}
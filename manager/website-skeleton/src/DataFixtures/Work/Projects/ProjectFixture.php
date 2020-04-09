<?php
declare(strict_types=1);
namespace App\DataFixtures\Work\Projects;

use App\DataFixtures\Work\Members\MembersFixture;
use App\Model\Work\Entity\Members\Member\Member;
use App\Model\Work\Entity\Projects\Project\Department\Id as DepartmentId;
use App\Model\Work\Entity\Projects\Project\Id;
use App\Model\Work\Entity\Projects\Project\Project;
use App\Model\Work\Entity\Projects\Role\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixture extends Fixture implements DependentFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		/**
		 * @var Member $admin
		 */
		$admin=$this->getReference(MembersFixture::REFERENCE_ADMIN);
		/**
		 * @var Role $manage
		 */
		$manage=$this->getReference(RoleFixture::REFERENCE_MANAGER);
		$active=$this->createProject('First Project',1);
		$active->addDepartment($development=DepartmentId::next(),'Development');
		$active->addDepartment(DepartmentId::next(),'Marketing');
		$active->addMember($admin,[$development],[$manage]);
		$manager->persist($active);

		$active=$this->createProject('Second Project',2);
		$manager->persist($active);

		$active=$this->createArchivedProject('Third Project',3);
		$manager->persist($active);

		$manager->flush();
	}

	public function createArchivedProject(string $name,int $sort):Project
	{
		$project=$this->createProject($name,$sort);
		$project->archive();
		return $project;

	}

	public function createProject(string $name,int $sort):Project
	{
		return new Project(
			Id::next(),
			$name,
			$sort
		);

	}

	public function getDependencies():array
	{
		return [
			MembersFixture::class,
			RoleFixture::class,
		];

	}
}
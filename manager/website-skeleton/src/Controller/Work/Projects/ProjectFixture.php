<?php
declare(strict_types=1);
namespace App\DataFixtures\Work\Projects;

use App\Model\Work\Entity\Projects\Project\Id;
use App\Model\Work\Entity\Projects\Project\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixture extends Fixture
{
	public function load(ObjectManager $manager)
	{
		$active=$this->createProject('First Project',1);
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
}
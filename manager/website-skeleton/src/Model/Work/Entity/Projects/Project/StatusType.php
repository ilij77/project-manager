<?php


namespace App\Model\Work\Entity\Projects\Project;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class StatusType extends StringType
{
	public const NAME = 'work_projects_project_status';

	public function convertToDatabaseValue($value, AbstractPlatform $platform)
	{
		return $value instanceof Status ? $value->getName() : $value;
	}

	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		return !empty($value) ? new Status($value) : null;
	}

	public function getName(): string
	{
		return self::NAME;
	}
}
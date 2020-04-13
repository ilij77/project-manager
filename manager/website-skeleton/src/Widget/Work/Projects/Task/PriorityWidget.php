<?php
declare(strict_types=1);
namespace App\Widget\Work\Projects\Task;


use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PriorityWidget extends AbstractExtension
{

	public function getFunctions()
	{
		return [
			new TwigFunction('work_projects_task_priority',[$this,'priority'],['needs_environment'=>true,'is_safe'=>['html']]),
		];
	}

	public function priority(Environment $twig,string $priority):string
	{
		return $twig->render('Widget/work/projects/task/priority.html.twig',['priority'=>$priority]);

	}
}

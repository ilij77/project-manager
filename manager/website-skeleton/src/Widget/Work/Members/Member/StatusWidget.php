<?php
declare(strict_types=1);
namespace App\Widget\Work\Members\Member;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class StatusWidget extends AbstractExtension
{

	public function getFunctions()
	{
		return [
			new TwigFunction('member_status',[$this,'status'],['needs_environment'=>true,'is_safe'=>['html']]),
		];
	}

	public function status(Environment $twig,string $status):string
	{
		return $twig->render('widget/work/member.status.hnml.twig',['status'=>$status]);

	}
}
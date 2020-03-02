<?php
declare(strict_types=1);

namespace App\Widget\User;


use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RoleWidget extends AbstractExtension
{
	public function getFunctions()
	{
		return[
			new TwigFunction('user_role',[$this,'role'],['needs_environment'=>true, 'is_safe'=>['html']]),
		];
	}

	public function role(Environment $twig,string $role):string
	{
		return $twig->render('Widget/User/role.html.twig',['role'=>$role]);

	}


}
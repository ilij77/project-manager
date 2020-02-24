<?php

declare(strict_types=1);
namespace App\Security;


use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
	public function checkPreAuth(UserInterface $identity)
{
	if (!$identity){
		$exception=new DisabledException('User account is disabled.');
		$exception->setUser($identity);
		throw $exception;
	}
}
public function checkPostAuth(UserInterface $identity)
{
	if (!$identity instanceof UserIdentity){
		return;
	}
}

}
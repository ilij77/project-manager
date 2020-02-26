<?php


namespace App\Controller\Auth\OAuth;


use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FacebookController extends AbstractController
{
	/**
	 * @Route("/oauth.facebook",name="oaith.facebook")
	 * @param ClientRegistry $clientRegistry
	 * @return Response
	 */

	public function connect(ClientRegistry $clientRegistry):Response
	{
		return $clientRegistry->getClient('facebook_main')->redirect(['public_profile']);
	}

	/**
	 * @Route("/ofuth/facebook/check",name="oauth.facebook_check")
	 * @return Response
	 */

	public function check():Response
	{
		return $this->redirectToRoute('home');

	}


}
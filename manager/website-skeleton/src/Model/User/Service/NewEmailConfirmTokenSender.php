<?php


namespace App\Model\User\Service;


use App\Model\User\Entity\User\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;

class NewEmailConfirmTokenSender
{
	private $from;
	/**
	 * @var MailerInterface
	 */
	private $mailer;
	/**
	 * @var Environment
	 */
	private $twig;

	public function __construct(MailerInterface $mailer,Environment $twig)
	{

		$this->mailer = $mailer;
		$this->twig = $twig;
		$this->from = 'mail@app.test';
	}

	public function send(Email $email,string $token):void
	{
		$message=(new TemplatedEmail())
			->from($this->from)
			->to($email->getValue())
			->subject('Email Confirmation.')
			->htmlTemplate('mail/user/email.html.twig')
			->context(['token'=>$token]);
		$this->mailer->send($message);

//		if (!$this->mailer->send($message)){
//			throw new \RuntimeException('Unable to send message.');
//		}
	}

}
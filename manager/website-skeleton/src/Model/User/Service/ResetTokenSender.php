<?php


namespace App\Model\User\Service;


use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\ResetToken;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;

class ResetTokenSender
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

	public function send(Email $email,ResetToken $token):void
	{
		$message=(new TemplatedEmail())
			->from($this->from)
			->to($email->getValue())
			->subject('Password resetting!')
			->htmlTemplate('mail/user/reset.html.twig')
			->context(['token'=>$token->getToken()]);


			$this->mailer->send($message);


		//if (!$this->mailer->send($message)){
			//throw new \RuntimeException('Unable to send message.');
		//}
	}

}
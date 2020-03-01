<?php
declare(strict_types=1);

namespace App\Command\User;
use App\Model\User\UseCase\SignUp\Confirm;
use App\ReadModel\User\UserFetcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Form\Exception\LogicException;

class ConfirmCommand extends Command
{
	/**
	 * @var UserFetcher
	 */
	private $users;
	/**
	 * @var Confirm\Manual\Handler
	 */
	private $handler;

	public function __construct(UserFetcher $users, Confirm\Manual\Handler $handler)
	{

		$this->users = $users;
		$this->handler = $handler;
		parent::__construct();
	}
	protected function configure()
	{
		$this->setName('user:confirm')
			->setDescription('Confirm signed up user');
	}
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$helper=$this->getHelper('question');
		$email=$helper->ask($input,$output,new Question('Email: '));
		if (!$user=$this->users->findByEmail($email)){
			throw new LogicException('User is not found.');
		}
		$command=new Confirm\Manual\Command($user->id);
		$this->handler->handle($command);
		$output->writeln('<info>Done!</info>');
	}

}
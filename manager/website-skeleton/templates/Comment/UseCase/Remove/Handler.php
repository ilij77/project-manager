<?php
declare(strict_types=1);

namespace App\Model\Comment\UseCase\Comment\Remove;


use App\Model\Comment\Entity\Comment\AuthorId;
use App\Model\Comment\Entity\Comment\Comment;
use App\Model\Comment\Entity\Comment\CommentRepository;
use App\Model\Comment\Entity\Comment\Entity;
use App\Model\Comment\Entity\Comment\Id;
use App\Model\Flusher;

class Handler
{

	private $comments;

	private $flusher;

	public function __construct(CommentRepository $comments, Flusher $flusher)
	{

		$this->comments = $comments;
		$this->flusher = $flusher;
	}

	public function handle(Command $command):void
	{
		$comment=$this->comments->get(new Id($command->id));
		$comment->remove($comment);
		$this->flusher->flush();

	}

}
<?php

declare(strict_types=1);
namespace App\Model\Comment\Entity\Comment;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="comment_comments",indexes={
 *     @ORM\Index(columns={"date"}),
 *     @ORM\Index(columns={"entity_type","entity_id"})
 *	 })
 */
class Comment
{

	/**
	 * @var Id
	 * @ORM\Column(type="comment_comment_id")
	 * @ORM\Id()
	 */
	public $id;
	/**
	 * @var \DateTimeImmutable
	 * @ORM\Column(type="datetime_immutable")
	 */
	public $date;
	/**
 	* @var AuthorId
	 * @ORM\Column(type="comment_comment_author_id")
 	*/
	public $authorId;
	/**
	 * @var string
	 * @ORM\Column(type="text")
	 */
	public $text;
	/**
	 * @var Entity
	 * @ORM\Embedded(class="Entity")
	 */
	public $entity;
	/**
	 * @var \DateTimeImmutable
	 * @ORM\Column(type="datetime_immutable",nullable=true,name="update_date")
	 */
	private $updateDate;


	public function __construct(AuthorId$author, Id $id, \DateTimeImmutable $date, string $text, Entity $entity)
	{

		$this->authorId = $author;
		$this->id = $id;
		$this->date = $date;
		$this->text = $text;
		$this->entity = $entity;
	}

	public function edit(\DateTimeImmutable $date,string $text):void
	{
		$this->updateDate=$date;
		$this->text=$text;
	}


	public function getAuthorId(): AuthorId
	{
		return $this->authorId;
	}

	public function getId(): Id
	{
		return $this->id;
	}

	public function getEntity(): Entity
	{
		return $this->entity;
	}

	public function getText(): string
	{
		return $this->text;
	}

}
<?php
declare(strict_types=1);

namespace App\Controller\Work\Projects;


use App\Controller\ErrorHandler;
use App\ReadModel\Work\Projects\Project\ProjectFetcher;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\ReadModel\Work\Projects\Project\Filter;
use App\Model\Work\UseCase\Projects\Project\Create;

/**
 * @Route("/work/projects",name="work.projects")
 */
class ProjectsController extends AbstractController
{
	private const  PER_PAGE=20;

	private $errors;

	public function __construct(ErrorHandler $errors)
	{


		$this->errors = $errors;
	}

	/**
	 * @Route("",name="")
	 * @param Request $request
	 * @param ProjectFetcher $fetcher
	 * @return Response
	 */
	public function index(Request $request,ProjectFetcher $fetcher):Response
	{
		if ($this->isGranted('ROLE_WORK_MANAGE_PROJECTS')){
			$filter = Filter\Filter::all();
		}else{
			$filter = Filter\Filter::forMember($this->getUser()->getId());
		}


		$form = $this->createForm(Filter\Form::class, $filter);
		$form->handleRequest($request);

		$pagination = $fetcher->all(
			$filter,
			$request->query->getInt('page', 1),
			self::PER_PAGE,
			$request->query->get('sort', 'name'),
			$request->query->get('direction', 'asc')
		);

		return $this->render('app/work/projects/index.html.twig', [
			'pagination' => $pagination,
			'form' => $form->createView(),
		]);

	}

	/**
	 * @Route("/create",name=".create")
	 * @param Request $request
	 * @param ProjectFetcher $fetcher
	 * @param Create\Handler $handler
	 * @return Response
	 */
	public function create(Request $request,ProjectFetcher $fetcher,Create\Handler $handler):Response
	{
		$this->denyAccessUnlessGranted('ROLE_WORK_MANAGER_PROJECTS');
		$command=new Create\Command();
		$form = $this->createForm(Create\Form::class, $command);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			try {
				$handler->handle($command);
				return $this->redirectToRoute('work.projects');
			} catch (\DomainException $e) {
				$this->errors->handle($e);
				$this->addFlash('error', $e->getMessage());
			}
		}

		return $this->render('app/work/projects/create.html.twig', [
			'form' => $form->createView(),
		]);

	}

}
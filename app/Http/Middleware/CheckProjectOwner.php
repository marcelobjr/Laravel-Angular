<?php

namespace Code\Http\Middleware;

use Closure;
use Code\Repositories\ProjectRepository;

class CheckProjectOwner
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * CheckProjectOwner constructor.
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $request->project;

        if($this->repository->isOwner($projectId,$userId) == false)
        {
            return ['error' => 'Access forbiden', 'message'=> 'Usuário não autorizado'];
        }
        return $next($request);
    }
}

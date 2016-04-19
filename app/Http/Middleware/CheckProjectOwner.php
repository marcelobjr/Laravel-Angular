<?php

namespace Code\Http\Middleware;

use Closure;
use Code\Services\projectService;

class CheckProjectOwner
{
    /**
     * @var projectService
     */
    private $service;

    /**
     * CheckProjectOwner constructor.
     * @param projectService $service
     */
    public function __construct(projectService $service)
    {
        $this->service = $service;
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
        $projectId = $request->route('id') ? $request->route('id') : $request->route('project');

        if ($this->service->checkProjectOwner($projectId) == false) {
            return ['error' => 'Access forbidden.'];
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ApiResponseService;
use App\Http\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {}
    private $view_path = 'pages.admin.dashboard.tasks.';
    /**
     * Display a listing of tasks.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tasks = $this->taskService->index();
        $data = [
            'tasks'    => $tasks
        ];
        return view($this->view_path . 'index',$data);
    }
}

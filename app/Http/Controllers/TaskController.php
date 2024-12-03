<?php

namespace App\Http\Controllers;

use App\Enum\FetchDataFunctionsEnum;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\ApiResponseService;
use App\Http\Services\TaskService;
use App\Models\Task;

class TaskController extends Controller
{

    /**
     * TaskController constructor.
     *
     * @param TaskService $taskService
     */
    public function __construct(protected TaskService $taskService)
    {}

    /**
     * Display a listing of tasks.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $tasks = $this->taskService->index();
        return ApiResponseService::successResponse($tasks);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param StoreTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTaskRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->taskService->store($request);
        return ApiResponseService::successResponse();
    }

    /**
     * Display the specified task.
     *
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Task $task): \Illuminate\Http\JsonResponse
    {
        return ApiResponseService::successResponse(new TaskResource($task));
    }

    /**
     * Update the specified task in storage.
     *
     * @param Task $task
     * @param UpdateTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Task $task, UpdateTaskRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->taskService->update($task, $request);
        return ApiResponseService::successResponse();
    }

    /**
     * Remove the specified task from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task): \Illuminate\Http\JsonResponse
    {
        $this->taskService->destroy($task);
        return ApiResponseService::successResponse();
    }
}

<?php

namespace App\Http\Services;

use App\Enum\FetchDataFunctionsEnum;
use App\Http\DTOs\ImagesTaskData;
use App\Http\DTOs\TaskData;
use App\Http\Repositories\ImagesTasksRepo;
use App\Http\Repositories\TaskRepo;
use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;

class TaskService
{


    public function __construct(
       protected  TaskRepo $taskRepo,
       protected  ImagesTasksRepo $imagesTasksRepo
    )
    {}

    /**
     * Fetch all tasks.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->taskRepo->fetch(FetchDataFunctionsEnum::GET);
    }

    /**
     * Store a new task along with its images.
     *
     * @param FormRequest $request
     * @return Task
     */
    public function store(FormRequest $request): Task
    {
        return TransactionServier::performTransaction(function () use ($request) {
            $taskData = TaskData::fromObject($request)->all();
            $task = $this->taskRepo->create($taskData);

            $this->storeTaskImages($task, $request->images);

            return $task;
        });
    }

    /**
     * Update an existing task along with its images.
     *
     * @param Task $task
     * @param FormRequest $request
     * @return bool
     */
    public function update(Task $task, FormRequest $request): bool
    {
        return TransactionServier::performTransaction(callback: function () use ($task, $request) {
            $this->deleteTaskImages($request->imageDeleteIds);
            $this->storeTaskImages($task, $request->images);
            $taskData = TaskData::fromObject($request)->all();
            return $this->taskRepo->updateModel($task, $taskData);
            SendNotificationService::send('The mission status has been modified by '.auth()->user()->name);
        });
    }

    /**
     * Delete a task along with its associated images.
     *
     * @param Task $task
     * @return void
     */
    public function destroy(Task $task): void
    {
        foreach ($task->images as $image) {
            File::delete(public_path($image->image));
        }
        $task->delete();
    }

    /**
     * Store images for a given task.
     *
     * @param Task $task
     * @param array $images
     * @return void
     */
    private function storeTaskImages(Task $task, $images): void
    {
        foreach ($images as $image) {
            $imageData = ImagesTaskData::fromObject(null, ['image' => $image])->all();
            $task->images()->create($imageData);
        }
    }

    /**
     * Delete specified images by their IDs.
     *
     * @param array $imageIds
     * @return void
     */
    private function deleteTaskImages(array $imageIds): void
    {
        foreach ($imageIds as $imageId) {
            $image = $this->imagesTasksRepo->find($imageId);
            File::delete(public_path($image?->image));
            $image?->delete();
        }
    }
}

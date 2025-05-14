<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    use AuthorizesRequests;
    /**
     * This property is used to handle various operations related to tasks,
     * such as creating, updating.
     *
     * @var TaskService
     */
    protected $taskService;

    /**
     * Constructor for the PostController class.
     * 
     * Initializes the $taskService property via dependency injection.
     * 
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * This method return all tasks from database.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(Task::all()->load('assignees'));
    }

    /**
     * Store a new task in the database using the TaskService via the addTask method
     * passes the validated request data to addTask.
     * 
     * @param StoreTaskRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create',Task::class);
        return $this->success($this->taskService->addTask($request->validated()),'added task successfuly',201);
    }

    /**
     * Get task from database.
     * 
     * @param Task $task
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $this->success($task->load('assignees'));
    }

    /**
     * Update a task in the database using the TaskService via the updateTask method.
     * passes the validated request data to updateTask.
     * 
     * @param UpdateTaskRequest $request
     * 
     * @param Task $task
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        return $this->success($this->taskService->updateTask($request->validated(),$task),'updated successfuly');
    }

    /**
     * Delete task from database.
     * 
     * @param Task $task
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('forceDelete', $task);
            $this->taskService->deleteTask($task);
            return $this->success(null,'Deleted successfuly',204);
    }
}

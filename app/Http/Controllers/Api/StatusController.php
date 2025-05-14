<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Status\StoreStatusRequest;
use App\Http\Requests\Status\UpdateStatusRequest;
use App\Models\Status;
use App\Services\StatusService;

class StatusController extends Controller
{
    /**
     * This property is used to handle various operations related to statuses,
     * such as creating, updating.
     *
     * @var StatusService
     */
    protected $statusService;

    /**
     * Constructor for the PostController class.
     * 
     * Initializes the $taskService property via dependency injection.
     * 
     * @param TaskService $taskService
     */
    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    /**
     * This method return all status from database.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(Status::all());
    }

    /**
     * Store a new status in the database using the StatusService via the addStatus method
     * passes the validated request data to addStatus.
     * 
     * @param StoreStatusRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusRequest $request)
    {
        return $this->success($this->statusService->addStatus($request->validated()),'added status successfuly'
                    ,201);
    }

    /**
     * Get status from database.
     * 
     * @param Status $status
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return $this->success($status);
    }

    /**
     * Update a post in the database using the StatusService via the updateStatus method.
     * passes the validated request data to updateStatus.
     * 
     * @param UpdateStatusRequest $request
     * 
     * @param Status $status
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatusRequest $request, Status $status)
    {
        return $this->success($this->statusService->updateStatus($request->validated(),$status),'updated successfuly');
    }

    /**
     * Delete status from database.
     * 
     * @param Status $status
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();
        return $this->success('Deleted successfuly', 204);
    }
}

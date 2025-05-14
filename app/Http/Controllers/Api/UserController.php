<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * This property is used to handle various operations related to users,
     * such as creating, updating.
     *
     * @var UserService
     */
    protected $userService;

    /**
     * Constructor for the PostController class.
     * 
     * Initializes the $userService property via dependency injection.
     * 
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * This method return all users from database.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',User::class);
        return $this->success(User::all());
    }

    /**
     * Register a new User in the database using the UserService via the createUser method
     * passes the validated request data to createUser.
     * 
     * @param CreateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->authorize('create',User::class);
        return $this->success(
            $this->userService->createUser($request->validated()), 'User has been registered successfully',
            201);
    }

    /**
     * Get task from database.
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view',$user);
        return $this->success($user);
    }

    /**
     * Update a user in the database using the UserService via the updateUser method.
     * passes the validated request data to updateUser.
     * 
     * @param UpdateUserRequest $request
     * 
     * @param Task $task
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        return $this->success($this->userService->updateUser($request->validated(),$user),'updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return $this->success(null,'Deleted successfuly',204);
    }
}

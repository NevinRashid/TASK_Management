<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Add new user to the database.
     * 
     * @param array $userdata
     * 
     * @return User $user
     */
    public function createUser(array $data)
    {
        try{
            $data['password'] = Hash::make($data['password']);
            unset($data['role']);
            return User::create($data);

        }catch(\Throwable $th){

        }    
    }

    /**
     * Get the specified user from the database.
     * 
     * @param array $userdata
     * 
     * @return User $user
     */
    public function getUser(array $data)
    {
        try{
            $user = User::query()->where('email', $data['email'])->first();
            return $user;

        }catch(\Throwable $th){

        }
    }

    /**
     * Update the specified user in the database.
     * 
     * @param array $userdata
     * @param User $user
     * 
     * @return User $user
     */

    public function updateUser(array $data, User $user){
        try{
            
            $user->update(array_filter($data));
            return $user;
        }catch(\Throwable $th){
            
        }
    }

    /**
     * Delete user's tokens from the database.
     * 
     * @param Request @request
     * 
     * @return void
     */
    public function deleteUserTokens(Request $request)
    {
        try{
            $request->user()->currentAccessToken()->delete();

        }catch(\Throwable $th){

        }
    }

}

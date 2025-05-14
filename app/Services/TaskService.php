<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Add new task to the database.
     * 
     * @param array $taskdata
     * 
     * @return Task $task
     */
    public function addTask(array $data){
        try{
            $task = Task::create($data);
            $task->assignees()->attach($data['assignee_ids']);
            return $task->load('assignees');
        }catch(\Throwable $th){

        }
    }

    /**
     * Update the specified task in the database.
     * 
     * @param array $taskdata
     * @param Task $task
     * 
     * @return Task $task
     */

    public function updateTask(array $data, Task $task){
        try{
            
            $task->update(array_filter($data));
            $task->assignees()->sync($data['assignee_ids']);
            return $task->load('assignees');
        }catch(\Throwable $th){
            
        }
    }

        /**
     * Delete the specified task from the database after deleting the relationships first.
     * 
     * @param Task $task
     * 
     * @return bool
     */

    public function deleteTask( Task $task){
        try{
            $task->assignees()->detach();
            $task->delete();
            return true;
        }catch(\Throwable $th){
            
        }
    }

    
}

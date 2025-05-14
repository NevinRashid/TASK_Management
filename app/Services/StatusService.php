<?php

namespace App\Services;

use App\Models\Status;

class StatusService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Add new status to the database.
     * 
     * @param array $statusdata
     * 
     * @return Status $status
     */
    public function addStatus(array $data){
        try{
            return Status::create($data);
        }catch(\Throwable $th){

        }
    }

    /**
     * Update the specified status in the database.
     * 
     * @param array $statusdata
     * @param Status $status
     * 
     * @return Status $status
     */

    public function updateStatus(array $data, Status $status){
        try{
            $status->update(array_filter($data));
            return $status;
        }catch(\Throwable $th){
            
        }
    }
    
}


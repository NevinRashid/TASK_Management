<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'due_date',
        'status_id',
        'assigned_by',
        'actual_start_date',
        'actual_end_date',
    ];

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function creator(){
        return $this->belongsTo(User::class);
    }

    public function assignees(){
        return $this->belongsToMany(User::class,'task_user','task_id','user_id');
    }
}

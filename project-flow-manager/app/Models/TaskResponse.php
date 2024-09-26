<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskResponse extends Model
{
    use HasFactory;

    protected $table='task_responses';

    protected $fillable = [
        'message',
    ];
    	 	 	 	
    //or
    //protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table='tasks';

    /*protected $fillable = [
        'name',
        'description',
        'project_id ',
        'user_id',
        'status',
        'privacy',
        'due_date ',
    ];*/
    	 	 	 	
    //or
    protected $guarded = [];

    //public $timestamps = false ;
}

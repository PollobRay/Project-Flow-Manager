<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectParticipant extends Model
{
    use HasFactory;

    protected $table='project_participants';

    protected $fillable = [
        'project_id',
        'user_id',
    ];

    //or
    //protected $guarded = [];

    public $timestamps = false ; //created_at, updated_at column not to include
}

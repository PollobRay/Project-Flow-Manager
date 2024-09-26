<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $table='projects';

    protected $fillable = [
        'name',
        'description',
        'image',
        'privacy',
        'leader_id',
        'category_id',
    ];

    //or
    //protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table='categories';

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    //or
    //protected $guarded = [];

    public $timestamps = false ; //created_at, updated_at column not to include
}

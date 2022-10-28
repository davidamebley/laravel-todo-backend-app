<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'user_id',      #should be modified to allow auto fill from ref. table
        'status'
    ];
}

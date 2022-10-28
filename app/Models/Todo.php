<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [ //These are values that are provided explicitly
        'name',
        'description',
        'user_id',
        'status'
    ];
}

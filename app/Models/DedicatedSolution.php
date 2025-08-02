<?php

// app/Models/DedicatedSolution.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DedicatedSolution extends Model
{
    use HasFactory;

    protected $fillable = [
        'caption',
        'title',
        'description',
        'image',
        'video_url',
    ];
}

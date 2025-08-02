<?php

// app/Models/TechStack.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechStack extends Model
{
    protected $fillable = ['platform', 'stack_name', 'description'];

    // TechStack model
    public function programmingLanguages()
    {
        return $this->belongsToMany(ProgrammingLanguage::class, 'programming_language_tech_stack');
    }

}

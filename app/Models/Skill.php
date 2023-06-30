<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillabele = ['name', 'image'];

    public function Projects()
    {
        return $this->hasMany(Project::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'development_studio_id'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
    public function developmentStudio()
    {
        return $this->belongsTo(DevelopmentStudio::class);
    }
}

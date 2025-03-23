<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = ['fullname'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function evaluation()
    {
        return $this->belongsToMany(Subject::class, 'evaluations_students');
    }
}

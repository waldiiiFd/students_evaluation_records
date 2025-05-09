<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = ['fullname', 'group_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function evaluation()
    {
        return $this->belongsToMany(Subject::class, 'routes');
    }

    public static function rules()
    {
        return [
            'fullname' => 'required|string|max:255',
            'group_id' => 'required|exists:groups,id'
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;
    
    protected $fillable = ['name'];

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}

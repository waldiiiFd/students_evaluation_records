<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'routes';

    protected $fillable = [
        'student_id',
        'evaluation_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public static function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'evaluation_id' => 'required|exists:evaluations,id'
        ];
    }
}

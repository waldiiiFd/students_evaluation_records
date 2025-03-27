<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    /** @use HasFactory<\Database\Factories\EvaluationFactory> */
    use HasFactory;
    protected $fillable = ['type', 'grade', 'evaluation_date', 'subject_id', 'student_id'];
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'route');
    }

    public static function rules()
    {
        return [
            'type' => 'required|string|max:255',
            'grade' => 'nullable|numeric',
            'evaluation_date' => 'required|date',
            'subject_id' => 'required|exists:subjects,id',
        ];
    }
}

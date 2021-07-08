<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "phone",
        "email",
        "birthday",
        "gender"
    ];

    protected $with = ["classes"];

    public function classes()
    {
        return $this->belongsToMany(
            Classe::class,
            "class_students",
            "student_id",
            "class_id"
        );
    }
}

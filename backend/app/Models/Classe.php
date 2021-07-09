<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $table = "classes";

    protected $fillable = [
        "school_id",
        "nivel_id",
        "year",
        "serie",
        "turn"
    ];

    protected $with = ["level", "school"];

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            "class_students",
            "class_id",
            "student_id"
        );
    }

    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }

    public function level()
    {
        return $this->belongsTo(EducationalLevel::class, "nivel_id");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "address",
        "street",
        "neighborhood",
        "number",
        "zip"
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class, "school_id");
    }
}

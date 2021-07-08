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

    protected $casts = [
        "created_at" => "datetime:d/m/Y H:i:s",
        "updated_at" => "datetime:d/m/Y H:i:s",
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class, "school_id");
    }
}

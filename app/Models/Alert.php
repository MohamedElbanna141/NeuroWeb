<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable =[
        "color",
        "category",
        "title",
        "description",
        "date",
        "time",
        "image",
        "user_id"
    ];
}

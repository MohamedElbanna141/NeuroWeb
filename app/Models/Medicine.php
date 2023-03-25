<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory; 
     
    protected $fillable = [
        "name",
        "image",
        "size",
        "effect_material",
        "price",
        "side_effects", 
        "section",
        "description",
        "how_to_use",
        
    ];
}

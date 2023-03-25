<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    
    use HasFactory;

    
    protected $fillable = [
            "first_name",
            "last_name",
            "assistant",
            "offers",
            "sections",
            "image",
            "price",
            "phone_number",
            "about",
            "schedule",
            "time",
            "rate",
            "address" 
    ];
    

    
}



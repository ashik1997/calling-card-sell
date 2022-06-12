<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinuteForCountry extends Model
{
    use HasFactory;
    public function rate_plan(){
        return $this->belongsTo(RatePlan::class);
    }
}

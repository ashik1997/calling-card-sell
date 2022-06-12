<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerCard extends Model
{
    use HasFactory;
    public function rate_plan(){
        return $this->belongsTo(RatePlan::class);
    }
    public function reseller(){
        return $this->belongsTo(User::class, 'reseller_id');
    }
    public function added_by(){
        return $this->belongsTo(User::class, 'added_by_id');
    }
}

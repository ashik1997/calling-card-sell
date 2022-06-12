<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    public function rate_plan(){
        return $this->belongsTo(RatePlan::class);
    }
    public function batch(){
        return $this->belongsTo(Batch::class);
    }
    public function sell_card(){
        return $this->belongsTo(SellCard::class);
    }
    
}

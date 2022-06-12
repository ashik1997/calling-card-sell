<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellCard extends Model
{
    use HasFactory;
    public function card(){
        return $this->belongsTo(Card::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'reseller_id');
    }
}

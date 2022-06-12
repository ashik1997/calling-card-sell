<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerPayment extends Model
{
    use HasFactory;
    public function reseller(){
        return $this->belongsTo(User::class, 'reseller_id');
    }
    public function added_by(){
        return $this->belongsTo(User::class, 'added_by_id');
    }
}

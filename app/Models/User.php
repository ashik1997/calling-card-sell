<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function reseller_due($reseller_id){
        $reseller_payment = ResellerPayment::where('reseller_id',$reseller_id)->sum('amount');
        $reseller_balance = ResellerBalance::where('reseller_id',$reseller_id)->sum('amount');
        $due = $reseller_balance-$reseller_payment;
        return ($due>0)?$due:0;
    }
    public static function reseller_balance($reseller_id){
        $reseller_balance = ResellerBalance::where('reseller_id',$reseller_id)->sum('amount');
        $balance_added_by_reseller = ResellerBalance::where('added_by_id',$reseller_id)->sum('amount');
        $sell_card = SellCard::where('reseller_id',$reseller_id)->sum('sell_price');
        
        return $reseller_balance-$sell_card-$balance_added_by_reseller;

    }
    public static function reseller_paid($reseller_id){
        return $paid_amount = ResellerPayment::where('reseller_id',$reseller_id)->sum('amount');
    }
    public static function reseller_balance_add($reseller_id){
        return $reseller_balance = ResellerBalance::where('reseller_id',$reseller_id)->sum('amount');
    }
    public static function reseller_sell($reseller_id){
        return $sell_card = SellCard::where('reseller_id',$reseller_id)->sum('sell_price');;
    }
    public static function my_card_stock($reseller_id,$rate_plan_id){
        $my_card = ResellerCard::where('reseller_id',$reseller_id)->where('rate_plan_id',$rate_plan_id)->sum('qty');
        $added_by_me = ResellerCard::where('added_by_id',$reseller_id)->where('rate_plan_id',$rate_plan_id)->sum('qty');
        $my_sell_card = Card::leftJoin('sell_cards', function($join) {
          $join->on('cards.id', '=', 'sell_cards.card_id');
        })
        // ->whereNull('sell_cards.card_id')
        ->join('rate_plans', 'rate_plans.id', '=', 'cards.rate_plan_id')
        ->where('sell_cards.reseller_id',$reseller_id)
        ->where('cards.rate_plan_id',$rate_plan_id)
        ->select('cards.*')
        ->count();
        $sell = $added_by_me+$my_sell_card;
        return $my_stock = $my_card-$sell;
    }
    public static function my_sell_card($reseller_id,$rate_plan_id){
        $my_sell_card = Card::leftJoin('sell_cards', function($join) {
          $join->on('cards.id', '=', 'sell_cards.card_id');
        })
        // ->whereNull('sell_cards.card_id')
        ->join('rate_plans', 'rate_plans.id', '=', 'cards.rate_plan_id')
        ->where('sell_cards.reseller_id',$reseller_id)
        ->where('cards.rate_plan_id',$rate_plan_id)
        ->select('cards.*')
        ->count();
        return $sell = $my_sell_card;
        
    }
}

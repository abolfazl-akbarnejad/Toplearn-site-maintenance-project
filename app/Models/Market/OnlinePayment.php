<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlinePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['amount', 'user_id ', 'status', 'deteway', 'transaction_id', 'bank_first_response', 'bank_second_response'];
   
   
    public function payments()
    {
        return $this->morphMany('App/Model/Payment', 'paymentable');
    }
}

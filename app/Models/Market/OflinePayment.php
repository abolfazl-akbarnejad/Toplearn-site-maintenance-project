<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OflinePayment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'offline_payments';
    protected $fillable = ['amount', 'user_id ', 'status', 'transaction_id', 'pay_date'];

    public function payments()
    {
        return $this->morphMany('App/Model/Payment', 'paymentable');
    }
}

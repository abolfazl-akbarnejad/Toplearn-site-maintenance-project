<?php

namespace App\Models\Market;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['amount', 'user_id ', 'status', 'cash_receiver', 'pay_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

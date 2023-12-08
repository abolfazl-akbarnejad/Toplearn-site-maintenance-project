<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommonDiscount extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'common_discount';
    protected $fillable   = ['title', 'percentage', 'discount_celing', 'minimal_order_amount', 'status', 'start_date', 'end_date'];
}

<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmazingSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table  = 'amazing_sale';
    protected $fillable   = ['product_id', 'percentage', 'status', 'start_date', 'end_date'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

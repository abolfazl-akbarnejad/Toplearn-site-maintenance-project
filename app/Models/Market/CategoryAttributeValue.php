<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryAttributeValue extends Model
{
    use HasFactory, SoftDeletes;

    protected $table  = 'category_values';
    protected $fillable   = ['product_id', 'category_attribute_id', 'value', 'type'];


    public function categoryAttribute()
    {
        return $this->belongsTo(CategoryAttribute::class, 'category_attribute_id');
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}

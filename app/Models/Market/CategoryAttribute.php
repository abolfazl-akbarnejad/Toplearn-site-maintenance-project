<?php

namespace App\Models\Market;

use App\Models\Market\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryAttribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $table  = 'category_attributes';
    protected $fillable   = ['name', 'type', 'unit', 'category_id'];


    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function Attribute_value (){
        return $this->hasMany(CategoryAttributeValue::class);
    }
}

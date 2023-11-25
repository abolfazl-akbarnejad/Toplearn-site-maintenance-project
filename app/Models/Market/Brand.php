<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = ['persian_name', 'orginal_name', 'slug', 'logo', 'status', 'tags'];



    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'orginal_name',
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

<?php

namespace App\Models\Content;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Comment extends Model
{
    use HasFactory, SoftDeletes, sluggable;
    public function user()
    {
        return   $this->belongsTo(User::class, 'author_id');
    }

    //error
    public function commentable()
    {
        return $this->morphTo(__FUNCTION__, 'commentable_type', 'commentable_id');
    }


    // public function product()
    // {
    //     return   $this->belongsTo(product::class, 'commentable_id');
    // }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    protected $guarded = ['id'];
}

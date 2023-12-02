<?php

namespace App\Models\Content;

// use App\Models\User;

use App\Models\Market\Product;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    use HasFactory, SoftDeletes, sluggable;

    protected $guarded = ['id'];

    // protected $fillable = ['seen', 'parent_id', 'body', 'author_id ', 'commentable_id', 'commentable_type', 'approved', 'status'];

    public function user()
    {
        return   $this->belongsTo(User::class, 'author_id');
    }

    public function post()
    {
        return   $this->belongsTo(Post::class, 'commentable_id');
    }


    public function answer()
    {
        return   $this->belongsTo(Comment::class, 'parent_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'commentable_id');
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
}

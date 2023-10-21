<?php

namespace App\Models\Content;

use App\Models\Comment;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes, sluggable;
    public function postCategory()
    {
        return   $this->belongsTo(PostCategory::class, 'category_id');
    }

    //error
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable'); //commentable به معنای این است که توی مدل کامنت که در آرگمان اول وارد کردیم با این متود در این مدل ارتباط برقرار شده 
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }



    // protected $fillable = ['title', 'body', 'slug', 'image', 'status', 'commentable', 'tags', 'published_at', 'author_id', 'summery', 'category_id', '_token'];
    protected $guarded = ['id'];
}

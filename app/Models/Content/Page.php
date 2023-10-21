<?php


namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, SoftDeletes, sluggable;


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

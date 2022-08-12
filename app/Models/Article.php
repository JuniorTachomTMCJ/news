<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['author', 'title', 'description', 'url', 'urlToImage', 'content', 'source'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Article $article) {
            $date = new DateTime();
            $slug = Str::slug($article->title . '-' .  $date->format('dmYhis'), '-');

            $article->slug = $slug;
        });

        static::updating(function (Article $article) {
            $date = new DateTime();
            $slug = Str::slug($article->title . '-' .  $date->format('dmYhis'), '-');

            $article->slug = $slug;
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_article');
    }
}
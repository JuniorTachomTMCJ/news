<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['label'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Category $category) {
            $date = new DateTime();
            $slug = Str::slug($category->label . '-' .  $date->format('dmYhis'), '-');

            $category->slug = $slug;
        });

        static::updating(function (Category $category) {
            $date = new DateTime();
            $slug = Str::slug($category->label . '-' .  $date->format('dmYhis'), '-');

            $category->slug = $slug;
        });
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
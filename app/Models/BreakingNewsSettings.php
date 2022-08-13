<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class BreakingNewsSettings extends Model
{
    use HasFactory;

    protected $fillable = ['text_color', 'bg_color'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (BreakingNewsSettings $breakingNewsSettings) {
            $date = new DateTime();
            $slug = Str::slug($date->format('dmYhis'), '-');

            $breakingNewsSettings->slug = $slug;
        });

        static::updating(function (BreakingNewsSettings $breakingNewsSettings) {
            $date = new DateTime();
            $slug = Str::slug($date->format('dmYhis'), '-');

            $breakingNewsSettings->slug = $slug;
        });
    }
}
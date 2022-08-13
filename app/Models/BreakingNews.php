<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BreakingNews extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'active'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (BreakingNews $breakingNews) {
            $date = new DateTime();
            $slug = Str::slug($breakingNews->content . '-' .  $date->format('dmYhis'), '-');

            $breakingNews->slug = $slug;
        });

        static::updating(function (BreakingNews $breakingNews) {
            $date = new DateTime();
            $slug = Str::slug($breakingNews->content . '-' .  $date->format('dmYhis'), '-');

            $breakingNews->slug = $slug;
        });
    }

    public function statusString()
    {
        return $this->active ? "Activée" : "Désactivée";
    }
}
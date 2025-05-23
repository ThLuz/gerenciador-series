<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cover'];
    //protected $with = ['seasons'];
    
    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('Nome');
        });

        static::deleting(function ($serie) {
        if ($serie->cover && \Illuminate\Support\Facades\Storage::disk('public')->exists($serie->cover)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($serie->cover);
        }
    });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Book extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'book_code',
        'title',
        'slug',
        'status',
        'cover',
        'rating'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    public function rentLogs()
    {
        return $this->hasMany(RentLog::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Book extends Model
{

    use HasSlug , HasFactory ; 

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'description',
        'total_copies',
        'available_copies',
        'degraded_copies',
        'views',
    ] ;
    
    public function category() {
        return $this->belongsTo(Category::class) ;
    }

    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


}

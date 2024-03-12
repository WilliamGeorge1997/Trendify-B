<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdImage;

class Ad extends Model
{
    use HasFactory;
    // protected $table = 'ads';
    // protected $fillable = [
    //     'title',
    //     'description',
    //     'negotiable',
    //     'location',
    //     'price',
    //     'category_id',
    // ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(AdImage::class);
    }
}

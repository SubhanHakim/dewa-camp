<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price_per_day',
        'stock',
        'category_id',
        'image',
        'fungsi',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

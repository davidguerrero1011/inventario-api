<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'category_id', 'name', 'description', 'price', 'stock'];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}

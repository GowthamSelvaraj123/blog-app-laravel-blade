<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'description',
        'author', 
        'image', 
        'category'
    ];
    public function categorys()
    {
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['title', 'sumary', 'content', 'image', 'category_id'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function imageUrl()
    {
        return  "/uploads/" . $this->image;
    }
}
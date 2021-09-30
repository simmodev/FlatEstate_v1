<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path',
    ];

    public function images(){
        return $this->belongsTo(Post::class, 'post_id');
    }


}

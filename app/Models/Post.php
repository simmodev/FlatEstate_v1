<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\False_;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'phoneNumber',
        'country',
        'city',
        'zipcode',
        'address',
        'lat',
        'lng',
        'deal',
        'type',
        'condition',
        'surface',
        'price',
        'first_image_path',
    ];

    public function ownedBy(User $user){
            return $user->id === $this->user_id;
    }

    public function images(){
        return $this->hasMany(PostImages::class,'post_id');
    }
}

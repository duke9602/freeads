<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = 
    ["title",
    "description",
    "price",
    "location",
    "condition", 
    "user_id",
    "category_id",
    ];
     
    public $timestamps = true;
    // je cree maintenant les relations

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function photos(){
        return $this->hasMany(Photo::class, "annonce_id");
    }
}

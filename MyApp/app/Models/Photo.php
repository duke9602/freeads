<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = ["path","annonce_id"];

    //relations 

    public function annonce(){
        return $this->hasMany(Annonce::class, "annonce_id");
    }
}

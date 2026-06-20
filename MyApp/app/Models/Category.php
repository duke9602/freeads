<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ["name"];

    // les relations 

    public function annonces(){
        return $this->belongsTo(Annonce::class);
    }
}

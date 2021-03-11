<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable=['name','type','image','business_id','cooked_at','quantity'];
    public function business(){
        $this->belongsTo(Business::class,'business_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clothe extends Model
{ 

    protected $fillable=['name','type','image','business_id','quantity'];
    public function business(){
        $this->belongsTo(Business::class,'buisness_id');
    }}
<?php

namespace App;
use App\Business;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable=['name','type','image','business_id','cooked_at','quantity'];
    public function Business(){
      return  $this->belongsTo(Business::class);
    }
}

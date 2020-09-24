<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
   protected $fillable=
   [
      'category_id',
      'season_name',
      'description',
      'image',
      'status',
      'maker_name',
      'maker_email',
      'trailer_link'];

   public function season_no(){
         return $this->hasMany('App\SeasonNo');
      }
}

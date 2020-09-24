<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonNo extends Model
{
    protected $fillable = ['season_id', 'season_no', 'status'];

    public function season(){
		return $this->belongsTo('App\Season');
	}
}

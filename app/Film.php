<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table    = 'films';
    protected $fillable = ['film_title','category_id','film_maker','film_maker_email',
                           'film_description','film_duration','film_trailer_link',
                           'film_file_link','delete_status','film_file'];
}

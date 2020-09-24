<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonEpisode extends Model
{
    protected $table    = 'season_episodes';
    protected $fillable = ['episode_title','season_id','season_no_s','episode_duration',
                           'episode_description','episode_link_trailor','episode_link'];
}

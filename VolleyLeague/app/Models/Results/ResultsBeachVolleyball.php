<?php

namespace App\Models\Results;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultsBeachVolleyball extends Model
{
    use HasFactory;

    protected $table = 'results_beachvolley';

    protected $primaryKey = 'result_id';

    protected $fillable = [

        'league_id',
        'match_id',
        'host_team_id',
        'guest_team_id',

        'matches_won',
        'sets_won',
        'points_won',
        'matches_lost',
        'sets_lost',
        'points_lost',

        'host_g3',
        'host_g2',
        'host_p1',
        'host_p0',
        'host_pg',
        'host_sf',
        'host_sc',
        'host_pf',
        'host_pc',
        'host_sanc',

        'guest_g3',
        'guest_g2',
        'guest_p1',
        'guest_p0',
        'guest_pg',
        'guest_sf',
        'guest_sc',
        'guest_pf',
        'guest_pc',
        'guest_sanc',

    ];
}

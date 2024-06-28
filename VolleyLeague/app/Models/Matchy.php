<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Matchy extends Model
{
    use HasFactory;
    
    protected $table = "matches";
    protected $primaryKey = 'match_id';
    
    
    protected $fillable = [
	  'host_team_id',
	  'guest_team_id',
	  'match_address_id',
	  'league_type',
	  'match_date',
	  'league_id',
	  'match_number',
	  'week_number',
	  'host_points',
	  'guest_points',
	  'match_status',
	];
   
    
}

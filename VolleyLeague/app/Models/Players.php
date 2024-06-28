<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;
    
    protected $table = "players";
    protected $primaryKey = 'player_id';
    
    
    protected $fillable = [
	  'team_id',
	  'league_id',
	  'name',
	  'surname_1',
	  'surname_2',
	  'sex',
	  'player_img_name',
	  'height',
	  'weight',
	  'country',
	  'age',
	  'birth_date',
	  'player_number', 
	  
	  'email',
	  'phone',
	  'address_id',
	];
	
	
}

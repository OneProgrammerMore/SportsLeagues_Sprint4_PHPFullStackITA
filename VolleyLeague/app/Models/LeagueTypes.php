<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueTypes extends Model
{
    use HasFactory;
    
    //Define the name of the primary key in order to locate the correct row with the function Model::find($id);
    protected $primaryKey = 'league_type_id';
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'league_id',
        'team_number',
        'team_name',
        'team_address_id',
        'team_responsible_id',
        'team_phone',
        'team_img_name',
        'team_email',
    ];

    // Define the name of the primary key in order to locate the correct row with the function Model::find($id);
    protected $primaryKey = 'team_id';
}

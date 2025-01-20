<?php

namespace App\Models;

use App\Enum\LeagueStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    // This code creates a fillable array that allows you to add items to the database from your Laravel application.
    // The strings identify the field in the database for the table "Leagues" that are going to be modified.
    protected $fillable = [
        'league_type_id',
        'league_type',
        'league_name',
        'league_status',
        'league_admin_id',
        'league_admin_id_2',
        'league_img_name',
        'league_starting_date',
        'league_finalization_date',
        'league_description',
        'league_channel',
        'league_official_web',
    ];

    // Define the name of the primary key in order to locate the correct row with the function Model::find($id);
    protected $primaryKey = 'league_id';

    /*
         * MOTHER OF ALL BUGS!!!
         * NOT POSSIBLE TO DO SO...
         * SOURCE: github.com/laravel/framework/issues/48110
         * THEREFORE Using a plain String from ENUM...
         */
    /* -- For future versions - Kept!
    protected $casts = [
        'league_status' => LeagueStatusEnum::class
    ];
    */
}

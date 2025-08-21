<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'person';

    protected $fillable = [
        'person_name',
        'person_surname_1',
        'person_surname_2',
        'person_email',
        'person_phone',
        'person_address_id',
    ];

    // Define the name of the primary key in order to locate the correct row with the function Model::find($id);
    protected $primaryKey = 'person_id';
}

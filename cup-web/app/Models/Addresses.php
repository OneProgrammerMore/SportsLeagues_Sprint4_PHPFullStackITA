<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'country',
        'postalcode',
        'city',
        'street',
        'number',
        'floor',
        'door',
    ];

    // Define the name of the primary key in order to locate the correct row with the function Model::find($id);
    protected $primaryKey = 'address_id';
}

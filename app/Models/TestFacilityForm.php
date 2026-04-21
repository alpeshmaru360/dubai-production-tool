<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestFacilityForm extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow the default Laravel convention
    protected $table = 'test_facility_form'; // Change this if your table is named differently

    protected $fillable = [
        'username',
        'f_name',
        'l_name',
        'ph_number',
        'email',
        'address',
    ];
}

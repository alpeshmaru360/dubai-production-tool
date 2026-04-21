<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WitnessForm extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow the default Laravel convention
    protected $table = 'witness_form'; // Change this if your table is named 'witness_form'

    protected $fillable = [
        'username',
        'phone',
        'email',
        'product_type',
        'preferred_date',
        'additional_notes',
    ];
}

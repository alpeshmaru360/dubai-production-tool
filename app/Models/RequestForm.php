<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow the default Laravel convention
    protected $table = 'request_form'; // Change this if your table is named 'request_form'

    protected $fillable = [
        'username',
        'phone',
        'email',
        'training_type',  // New field for training type
        'description',    // New field for description
    ];
}

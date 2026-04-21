<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerService extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow the default Laravel convention
    protected $table = 'coustomer_service'; // Change this if needed

    protected $fillable = [
        'username',
        'phone',
        'email',
        'message', // Field for suggestions
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow the default Laravel convention
    protected $table = 'contact_us'; // Change this if needed

    protected $fillable = [
        'section',
        'value',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackForm extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow the default Laravel convention
    protected $table = 'feedback_form'; // Change this if needed

    protected $fillable = [
        'username',
        'phone',
        'email',
        'suggestions', // Field for suggestions
    ];
}

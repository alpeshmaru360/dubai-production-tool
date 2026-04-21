<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferredDate extends Model
{
    use HasFactory;

    protected $table = 'preferred_dates';

    protected $fillable = [
        'dates',
        'product_type',
        'capacity',
        'meeting_link'
    ];

    // REMOVED: protected $casts = ['dates' => 'array'];
    // The dates field should be treated as a simple string, not JSON/array
}
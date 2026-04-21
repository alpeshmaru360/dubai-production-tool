<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WitnessWaitingList extends Model
{
    use HasFactory;

    protected $table = 'witness_waiting_list';

    protected $fillable = [
        'username',
        'phone',
        'email',
        'product_type',
        'preferred_date',
        'additional_notes',
    ];
}
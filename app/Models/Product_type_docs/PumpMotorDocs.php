<?php

namespace App\Models\Product_type_docs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PumpMotorDocs extends Model
{
    use HasFactory;

    protected $table = 'pump_motor_docs';
    protected $fillable = ['name'];
}

<?php

namespace App\Models\Product_type_docs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlDocs extends Model
{
    use HasFactory;

    protected $table = 'control_docs';
    protected $fillable = ['name'];
}

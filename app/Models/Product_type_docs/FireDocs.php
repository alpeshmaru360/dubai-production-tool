<?php

namespace App\Models\Product_type_docs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireDocs extends Model
{
    use HasFactory;

    protected $table = 'fire_docs';
    protected $fillable = ['name'];
}

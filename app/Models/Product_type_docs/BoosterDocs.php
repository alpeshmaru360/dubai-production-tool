<?php

namespace App\Models\Product_type_docs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoosterDocs extends Model
{
    use HasFactory;

    protected $table = 'booster_docs';
    protected $fillable = ['name'];
}

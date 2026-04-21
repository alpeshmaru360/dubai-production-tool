<?php

namespace App\Models\Product_type_docs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormDocs extends Model
{
    use HasFactory;

    protected $table = 'norm_docs';
    protected $fillable = ['name'];
}

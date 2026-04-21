<?php

namespace App\Models\Product_type_docs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoreoleDocs extends Model
{
    use HasFactory;

    protected $table = 'borehole_docs';
    protected $fillable = ['name'];
}

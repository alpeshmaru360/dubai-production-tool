<?php

namespace App\Models\Product_type_docs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelixDocs extends Model
{
    use HasFactory;

    protected $table = 'helix_docs';
    protected $fillable = ['name'];
}

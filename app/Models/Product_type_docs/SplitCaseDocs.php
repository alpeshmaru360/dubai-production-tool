<?php

namespace App\Models\Product_type_docs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SplitCaseDocs extends Model
{
    use HasFactory;

    protected $table = 'split_case_docs';
    protected $fillable = ['name'];
}

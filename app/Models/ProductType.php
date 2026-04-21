<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow the default Laravel convention
    protected $table = 'product_types'; // Change this if your table is named 'witness_form'

    // protected $fillabl = [
    //     'product_type_name' 
    // ];
}

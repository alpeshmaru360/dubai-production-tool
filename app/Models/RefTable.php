<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefTable extends Model
{
    use HasFactory;

    protected $table = 'ref_table';

    protected $fillable = [
        'country',
        'project_name',
        'discretion',
        'product_type',
        'project_pic'
    ];
}


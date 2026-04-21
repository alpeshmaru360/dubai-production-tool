<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductButtonTestFacility extends Model
{
    protected $table = 'product_buttons_test_facility';
    protected $fillable = ['button_text', 'button_link'];
}

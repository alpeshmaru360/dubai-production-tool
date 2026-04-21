<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductButton extends Model
{
    protected $fillable = ['button_text', 'button_link'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaImages extends Model
{
    use HasFactory;

    protected $table = 'media_images';
    protected $fillable = ['name'];
}

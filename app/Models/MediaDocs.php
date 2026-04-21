<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaDocs extends Model
{
    use HasFactory;

    protected $table = 'media_docs';
    protected $fillable = ['name'];
}

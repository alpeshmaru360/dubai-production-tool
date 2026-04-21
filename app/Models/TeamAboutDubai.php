<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamAboutDubai extends Model
{
    use HasFactory;

    protected $table = 'team_about_dubai';
    protected $fillable = [
        'profile_pic',
        'name',
        'designation',
        'email',
    ];
}
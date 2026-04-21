<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTestFacility extends Model
{
    use HasFactory;

    protected $table = 'team_test_facility';
    protected $fillable = [
        'profile_pic',
        'name',
        'designation',
        'email',
    ];
}
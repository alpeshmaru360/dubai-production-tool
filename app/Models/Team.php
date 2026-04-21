<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'team_setting';

    // Disable timestamps if your table doesn't have 'created_at' and 'updated_at' columns
    public $timestamps = false;

    // Define the fillable fields to allow mass assignment
    protected $fillable = ['profile_pic', 'name', 'designation', 'email'];
}

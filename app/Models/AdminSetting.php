<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'admin_setting';

    // Disable timestamps if your table doesn't have 'created_at' and 'updated_at' columns
    public $timestamps = false;

    // Define the fillable fields to allow mass assignment
    protected $fillable = ['lable', 'section_name', 'sub_title', 'value'];
}


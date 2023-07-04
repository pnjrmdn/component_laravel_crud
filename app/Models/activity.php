<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    use HasFactory;
    public $table = "activity";
    protected $fillable = ['name_activity', 'user_handle'];
}ß

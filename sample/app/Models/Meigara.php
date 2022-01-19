<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meigara extends Model
{
    use HasFactory;
    protected $fillable = ["symbol","meigara_name","currency"];
    protected $dates = ["created_at"];
}

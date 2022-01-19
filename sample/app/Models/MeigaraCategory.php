<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeigaraCategory extends Model
{
    use HasFactory;
    protected $fillable = ["category_name"];
    protected $dates = ["created_at"];
        
}

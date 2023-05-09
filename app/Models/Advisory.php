<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advisory extends Model
{
    use HasFactory;
    protected $fillable = ['date_memo','category','no_memo', 'title', 'signatory','date_posted','upload'];

}

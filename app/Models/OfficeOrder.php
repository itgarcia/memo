<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeOrder extends Model
{
    use HasFactory;
    protected $fillable = ['date_memo','no_memo', 'title', 'signatory','date_posted','upload'];

    public function employees()
{
	return $this->belongsToMany(Employee::class);
}

}



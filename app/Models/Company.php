<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'address', 'email'];

    // Relationship with employees
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name', 'company_id', 'email', 'phone'];

    // Relationship with company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getCompanyNameAttribute()
    {
        return $this->company->name;
    }
}

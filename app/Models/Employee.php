<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Employee extends Model
{
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}

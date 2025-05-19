<?php

namespace App\Modules\Customers\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'address2',
        'city',
        'state',
        'country',
        'postal_code'
    ];
}

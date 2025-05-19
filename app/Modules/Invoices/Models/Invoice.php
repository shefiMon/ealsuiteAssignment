<?php

namespace App\Modules\Invoices\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'date',
        'amount',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Modules\Customers\Models\Customer');
    }
}

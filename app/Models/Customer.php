<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'cpf'];

    public function customerId()
    {
        $customerId = Customer::with('sales')->latest()->first();
        $customer_id = $customerId->id;

        return $customer_id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'cpf'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sales()
    {
        return $this->hasOne(Sale::class);
    }

}

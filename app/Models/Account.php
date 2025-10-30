<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Transaction;

class Account extends Model
{
    protected $fillable = ['name', 'type', 'opening_balance', 'opening_date'];

    public function transactions(){
        return $this->hasMany(Transaction::class,'account_id');
    }
}

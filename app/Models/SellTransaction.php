<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SellTransaction extends Model
{
    protected $table = 'sell_transactions';
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_id',
        'transaction_date',
        'customer_name',
        'is_cancelled',
        'cancelled_at',
        'is_printed',
        'printed_at',
        'sub_total',
        'disc_amount',
        'grand_total',
        'notes',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
    ];

    public function details(){
        return $this->hasMany(SellTransactionDetail::class, 'sell_transaction_id', 'ID');
    }
    
}

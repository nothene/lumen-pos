<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class PurchaseTransactionDetail extends Model
{
    protected $table = 'purchase_transaction_details';
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'purchase_transaction_id',
        'raw_material_id',
        'qty',
        'price',
        'disc_1',
        'disc_2',
        'disc_amount',
        'total',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
    ];
 
    public function product(){
        return $this->belongsTo(Product::class, 'raw_material_id', 'ID');
    }

    public function purchase(){
        return $this->belongsTo(PurchaseTransaction::class, 'purchase_transaction_id', 'ID');
    }
}

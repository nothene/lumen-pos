<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_id', 
        'code', 
        'name',
        'color',
        'is_raw_material', 
        'is_active', 
        'uom_name', 
        'recipe_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
    ];

    public function prices(){
        return $this->hasMany(ProductPrice::class, 'product_id', 'ID');
    }
 
    public function recipe(){
        return $this->hasOne(Recipe::class, 'product_id', 'ID');
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'ID');
    }

    // Product belongs to many sells
    public function sell(){
        return $this->belongsToMany(SellTransaction::class)
        ->withPivot('qty', 'price', 'disc_1', 'disc_2', 'disc_amount', 'total', 'cogs');
    }

    public function purchaseDetail(){
        //return $this->belongsTo(Purchase::class);
    }    

    // What production produced this product
    public function producedBy(){
        return $this->hasOneThrough(Production::class, ProductionDetail::class);
    }
}

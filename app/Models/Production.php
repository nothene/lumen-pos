<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Production extends Model
{
    protected $table = 'productions';
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_id',
        'production_date',
        'recipe_id',
        'product_id',
        'qty_produced'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
    ];

    public function recipe(){
        return $this->belongsTo(Recipe::class, 'recipe_id', 'ID');
    }

    public function product(){
        $recipe = $this->recipe;
        return $recipe->hasOne(Product::class, 'recipe_id', 'ID');
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'ID');
    }
}

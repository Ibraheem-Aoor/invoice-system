<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\User;

class Section extends Model
{
    protected $fillable = [
        'section_name' , 'discreption' , 'user_id'
    ];


    /*
        -Each section have multi products.
        -Each Section have multi invoices
    */

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class , 'section_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoices::class , 'section_id');
    }
}

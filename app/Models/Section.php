<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Section extends Model
{
    protected $fillable = [
        'section_name' , 'discreption' ,
    ];


    /*
        -Each section have multi products.
        -Each Section have multi invoices
    */

    public function products()
    {
        return $this->hasMany(Product::class , 'section_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoices::class , 'section_id');
    }
}

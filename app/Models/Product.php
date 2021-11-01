<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
class Product extends Model
{//start class
    protected $fillable = [
        'product_name' , 'description' , 'section_id'
    ];
    //TimeStamps activated.

    /*
        -Each product belongs to one section
    */

    public function section()
    {
        return $this->belongsTo(Section::class , 'section_id');
    }
}//End class

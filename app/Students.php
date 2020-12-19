<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    //
    public $table = 'tbl_students';
   
    protected $fillable = [
        'name','grade','photo','city','country','address','dob'
    ];
}

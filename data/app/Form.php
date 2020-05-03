<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{

    protected $fillable = ['page_uid'];

    public function formFields(){
        return $this->hasMany('App\FormField');
    }

    public function formResults(){
        return $this->hasMany('App\FormResult');
    }
}

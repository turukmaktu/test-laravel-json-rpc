<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = ['code','form_id'];

    public function result(){
        return $this->hasOne('App\FormResult','form_field_id');
    }
}

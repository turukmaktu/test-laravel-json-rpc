<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormResult extends Model
{
    protected $fillable = ['value','form_field_id'];
}

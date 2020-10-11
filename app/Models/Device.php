<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'device_token', 'device_name', 'phone_number', 'region'
    ];


    public function messages(){
        return $this->hasMany('App\Models\Message', 'device_id', 'id' );
    }
}

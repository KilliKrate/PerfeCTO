<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Table Name
    protected $table = 'countries';
    // Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    protected $timestamps = false;
    // These fields cannot be mass assigned with an array
    protected $fillable = [
        'code',
        'name'
    ];

    public function city() {
        return $this->hasMany('App\Models\City', 'country');
    }
}

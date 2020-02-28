<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // Table Name
    protected $table = 'addresses';
    // Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
    // These fields cannot be mass assigned with an array
    protected $fillable = [
        'name',
        'cap',
        'lat',
        'lng',
        'city'
    ];

    public function company() {
        return $this->hasOne('App\Models\Company', 'address');
    }
    public function city() {
        return $this->belongsTo('App\Models\City', 'city');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // Table Name
    protected $table = 'cities';
    // Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    protected $timestamps = false;
    // These fields cannot be mass assigned with an array
    protected $fillable = [
        'name',
        'country'
    ];

    public function address() {
        return $this->hasMany('App\Models\Address', 'city');
    }

    public function country() {
        return $this->belongsTo('App\Models\Country', 'country');
    }
}

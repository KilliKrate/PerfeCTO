<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ateco extends Model
{
    // Table Name
    protected $table = 'ateco';
    // Primary Key
    protected $primaryKey = 'code';
    // Timestamps
    protected $timestamps = false;
    // These fields cannot be mass assigned with an array
    protected $guarded = [
        'code',
        'description'
    ];

    public function company() {
        return $this->hasMany('App\Models\Company', 'ateco');
    }
}

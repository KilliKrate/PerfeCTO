<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    // Table Name
    protected $table = 'types';
    // Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
    // These fields cannot be mass assigned with an array
    protected $fillable = [
        'name'
    ];

    public function company()
    {
        return $this->hasMany('App\Models\Company', 'type');
    }
}

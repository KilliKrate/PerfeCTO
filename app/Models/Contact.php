<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Table Name
    protected $table = 'contacts';
    // Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
    // These fields cannot be mass assigned with an array
    protected $fillable = [
        'type',
        'name',
        'company'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company');
    }
}

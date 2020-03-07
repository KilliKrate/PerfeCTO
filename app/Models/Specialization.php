<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    // Table Name
    protected $table = 'specializations';
    // Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
    // These fields cannot be mass assigned with an array
    protected $fillable = [
        'name'
    ];

    public function companies()
    {
        return $this->belongsToMany(
            'App\Models\Companies',
            'companies_specializations',
            'specialization',
            'company'
        );
    }
}

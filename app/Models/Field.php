<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    // Table Name
    protected $table = 'fields';
    // Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
    // These fields cannot be mass assigned with an array
    protected $fillable = [
        'name',
        'main'
    ];

    public function companies()
    {
        return $this->belongsToMany(
            'App\Models\Company',
            'companies_fields',
            'field',
            'company'
        );
    }
}

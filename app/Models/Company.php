<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Company extends Model
{
    // Table Name
    protected $table = 'companies';
    // Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
    // Fillable columns
    protected $fillable = [
        'business_name',
        'n_employees',
        'contract_date',
        'type',
        'ateco',
        'address'
    ];

    public function ateco_rel()
    {
        return $this->belongsTo('App\Models\Ateco', 'ateco', 'code');
    }

    public function type_rel()
    {
        return $this->belongsTo('App\Models\Type', 'type', 'id');
    }

    public function address_rel()
    {
        return $this->hasOne('App\Models\Address', 'id', 'address');
    }

    public function specializations()
    {
        return $this->belongsToMany(
            'App\Models\Specialization',
            'companies_specializations',
            'company',
            'specialization'
        );
    }

    public function fields()
    {
        return $this->belongsToMany(
            'App\Models\Field',
            'companies_fields',
            'company',
            'field'
        );
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact', 'contacts', 'company');
    }
}

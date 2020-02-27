<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // Table Name
    protected $table = 'companies';
    // Primary Key
    protected $primaryKey = 'id';
    // Timestamps
    protected $timestamps = false;
    // Fillable columns
    protected $fillable = [
        'business_name',
        'n_employees',
        'contract_date', 
        'type', 
        'ateco', 
        'address'
    ];
    // The contract date will be casted to datetime when accessed
    protected $casts = [
        'contract_date' => 'datetime'
    ];

    public function ateco() {
        return $this->belongsTo('App\Models\Ateco', 'ateco');
    }

    public function type() {
        return $this->belongsTo('App\Models\Type', 'type');
    }

    public function address() {
        return $this->belongsTo('App\Models\Address', 'address');
    }

    public function specializations() {
        return $this->belongsToMany(
            'App\Models\Specialization',
            'companies_specializations',
            'company',
            'specialization');
    }

    public function fields() {
        return $this->belongsToMany(
            'App\Models\Field',
            'companies_fields',
            'company',
            'field'
        );
    }

    public function contacts() {
        return $this->hasMany('App\Models\Contact', 'contacts', 'company');
    }
    
}

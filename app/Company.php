<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    const BEDEV = 1;
    const NIMU = 6;

    protected $fillable = [
        'name', 'owner', 'address', 'zip_code', 'city', 'oib', 'iban', 'bank_info', 'activity','logo_path', 'color',
    ];

    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}

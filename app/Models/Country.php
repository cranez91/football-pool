<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $appends = ['is_active'];
    protected $fillable = ['name', 'code', 'flag','active'];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function teams()
    {
        return $this->hasMany('App\Models\Team', 'country_id', 'id');
    }

    public function tournaments()
    {
        return $this->hasMany('App\Models\Tournament', 'country_id', 'id');
    }

    public function getIsActiveAttribute()
    {
        return $this->attributes['active'] ? 'Si' : 'No';
    }
}

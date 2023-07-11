<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class League extends Model
{
    use HasFactory;

    protected $table = 'leagues';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id','name', 'logo', 'slug', 'country_id'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public function rounds()
    {
        return $this->hasMany('App\Models\Round', 'league_id', 'id');
    }

    public function scopeFromActiveCountry($query)
    {
        return $query->whereHas('country', function (Builder $query) {
            $query->where('active', '=', 1);
        })
        ->get();
    }
}

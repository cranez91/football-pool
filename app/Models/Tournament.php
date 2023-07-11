<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $table = 'tournaments';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $appends = ['tournament_type', 'full_logo_src'];
    protected $fillable = ['uuid','name', 'logo', 'type', 'country_id', 'season'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function matchdays()
    {
        return $this->hasMany('App\Models\Matchday', 'tournament_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public function getTournamentTypeAttribute()
    {
        return  $this->attributes['type'] == 0 ? 'Clubes' : 'Selecciones';
    }

    public function getFullLogoSrcAttribute()
    {
        return "/img/tournaments/" . $this->attributes['logo'];
    }
}

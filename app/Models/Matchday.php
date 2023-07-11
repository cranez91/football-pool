<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchday extends Model
{
    use HasFactory;

    protected $table = 'matchdays';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $appends = ['is_active', 'is_current', 'formatted_price', 'formatted_prize'];
    protected $fillable = [
        'slug',
        'name', 
        'number_matches', 
        'current',
        'active',
        'league_id',
        'price', 
        'high_prize', 
        'low_prize', 
        'start_date', 
        'end_date'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function games()
    {
        return $this->hasMany('App\Models\Game', 'round_id', 'id');
        return $this->hasManyThrough(
            'App\Models\Game',
            'App\Models\Match',
            'game_id', // Foreign key on the environments table...
            'match_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
    }

    public function matches()
    {
        return $this->hasMany('App\Models\Match', 'matchday_id', 'id');
    }

    public function userMatchdays()
    {
        return $this->hasMany('App\Models\UserMatchday', 'matchday_id', 'id');
    }

    public function userMatches()
    {
        return $this->hasManyThrough('App\Models\UserMatch', 'App\Models\UserMatchday');
    }

    public function league()
    {
        return $this->belongsTo('App\Models\League', 'league_id', 'id');
    }

    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournament', 'tournament_id', 'id');
    }

    public function getIsActiveAttribute()
    {
        return $this->attributes['active'] ? 'Si' : 'No';
    }

    public function getIsCurrentAttribute()
    {
        return $this->attributes['current'] ? 'Si' : 'No';
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->attributes['price']);
    }

    public function getFormattedPrizeAttribute()
    {
        return '$' . number_format($this->attributes['high_prize']);
    }

    public function scopeCurrent($query)
    {
        return $query->where('current', 1)->with('matches')->first();
    }
}

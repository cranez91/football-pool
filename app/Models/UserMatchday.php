<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatchday extends Model
{
    use HasFactory;

    protected $table = 'user_matchdays';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $appends = ['is_paid', 'is_winner'];
    protected $fillable = ['uuid','user_id', 'matchday_id', 'paid', 'winner'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function matchday()
    {
        return $this->belongsTo('App\Models\Matchday', 'matchday_id', 'id');
    }

    public function userMatches()
    {
        return $this->hasMany('App\Models\UserMatch', 'user_matchday_id', 'id');
    }

    public function getIsPaidAttribute()
    {
        return  $this->attributes['paid'] == 0 ? 'No' : 'Si';
    }

    public function getIsWinnerAttribute()
    {
        return  $this->attributes['winner'] == 0 ? 'No' : 'Si';
    }
}

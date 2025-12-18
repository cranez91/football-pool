<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{
    use HasFactory;

    protected $table = 'user_matches';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['uuid','user_matchday_id', 'match_id', 'prediction', 'success'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function userMatchday()
    {
        return $this->belongsTo('App\Models\UserMatchday', 'user_matchday_id', 'id');
    }

    public function match()
    {
        return $this->belongsTo('App\Models\Matchup', 'match_id', 'id');
    }
}

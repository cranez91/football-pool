<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'id',
        'round_id',
        'home_id', 
        'away_id', 
        'home_score', 
        'away_score', 
        'referee', 
        'date',
        'time', 
        'status'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function round()
    {
        return $this->belongsTo('App\Models\Round', 'round_id', 'id');
    }

    public function home()
    {
        return $this->belongsTo('App\Models\Team', 'home_id', 'id');
    }

    public function away()
    {
        return $this->belongsTo('App\Models\Team', 'away_id', 'id');
    }

}

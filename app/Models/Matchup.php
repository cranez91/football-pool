<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchup extends Model
{
    use HasFactory;

    protected $table = 'matches';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'matchday_id',
        'result',
        'game_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function matchday()
    {
        return $this->belongsTo('App\Models\Matchday', 'matchday_id', 'id');
    }

    public function game()
    {
        return $this->belongsTo('App\Models\Game', 'game_id', 'id');
    }

}

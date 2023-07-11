<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $table = 'rounds';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $appends = ['is_current'];
    protected $fillable = ['id', 'name', 'current', 'league_id'];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function league()
    {
        return $this->belongsTo('App\Models\League', 'league_id', 'id');
    }

    public function games()
    {
        return $this->hasMany('App\Models\Game', 'round_id', 'id');
    }

    public function getIsCurrentAttribute()
    {
        return $this->attributes['current'] ? 'Yes' : 'No';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $appends = ['full_logo_src'];
    protected $fillable = [
        'id',
        'code',
        'name',
        'nickname',
        'logo',
        'active',
        'city',
        'stadium',
        'stadium_address',
        'stadium_image',
        'stadium_capacity',
        'league_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function league()
    {
        return $this->belongsTo('App\Models\League', 'league_id', 'id');
    }

    public function getFullLogoSrcAttribute()
    {
        return "/img/teams/" . $this->attributes['logo'];
    }
}

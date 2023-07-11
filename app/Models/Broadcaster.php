<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcaster extends Model
{
    use HasFactory;

    protected $table = 'broadcasters';
    protected $primaryKey = 'id';
    protected $appends = ['full_logo_src'];

    public function teams()
    {
        return $this->hasMany('App\Models\Team', 'broadcaster_id', 'id');
    }

    public function getFullLogoSrcAttribute()
    {
        return "/img/broadcasters/" . $this->attributes['logo'];
    }
}

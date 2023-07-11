<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalTeam extends Model
{
    use HasFactory;

    protected $table = 'national_teams';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $appends = ['full_logo_src'];
    protected $fillable = ['uuid','name', 'logo', 'active'];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function getFullLogoSrcAttribute()
    {
        return "/img/nations/" . $this->attributes['logo'];
    }
}

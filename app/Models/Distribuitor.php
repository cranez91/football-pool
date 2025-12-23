<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuitor extends Model
{
    use HasFactory;

    protected $table = 'distribuitors';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $appends = ['is_active'];
    protected $fillable = ['id', 'name', 'address', 'city', 'state', 'active', 'commission_pct'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getIsActiveAttribute()
    {
        return $this->attributes['active'] ? 'Si' : 'No';
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $table = 'seasons';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id', 'year', 'current', 'start', 'end', 'league_id'];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

}

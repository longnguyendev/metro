<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationModel extends Model
{
    use HasFactory;
    protected $table = 'stations';
    protected $primaryKey = 'station_id';
    protected $type = 'integer';
    public $incrementing = true;
}

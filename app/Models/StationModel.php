<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationModel extends Model
{
    use HasFactory;
    protected $table = 'stations';
    protected $primaryKey = 'station_id';
    protected $keyType = 'integer';
    public $incrementing = true;


    public function getRoutes()
    {
        return $this->belongsToMany('App\Models\RouteModel', 'route_station', 'station_id', 'route_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteModel extends Model
{
    use HasFactory;
    protected $table = 'routes';
    protected $primaryKey = 'route_id';
    protected $keyType = 'integer';
    // protected $hidden = ['pivot'];
    public $incrementing = true;


    public function getStations()
    {
        return $this->belongsToMany('App\Models\StationModel', 'route_station', 'route_id', 'station_id')->orderBy('order');
    }
}

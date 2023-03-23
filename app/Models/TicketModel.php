<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StationModel;
use App\Models\RouteModel;

class TicketModel extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $primaryKey = 'ticket_id';
    protected $keyType = 'integer';
    public $incrementing = true;

    public $timestamps = false;

    public function getRouteName($route_id)
    {
        return RouteModel::find($route_id)->name;
    }
    public function getStationName($station_id)
    {
        return StationModel::find($station_id)->name;
    }
}

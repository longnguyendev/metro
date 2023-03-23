<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use Illuminate\Http\Request;
use App\Models\TicketModel;
use App\Models\StationModel;
use App\Models\RouteModel;
use LDAP\Result;
use PHPUnit\Framework\Attributes\Ticket;

class TicketController extends Controller
{
    //
    public function bookTicket(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'station_id_start' => 'required|different:station_id_end',
        ]);
        $route_id = $request->route_id;
        $count = $request->count;
        $route = RouteModel::findOrFail($route_id);
        $phone = $request->phone;
        $stationStartIndex =  $route->getStations()->where('route_station.station_id', '=', $request->station_id_start)->get(['order'])->first()->order;
        $stationEndIndex = $route->getStations()->where('route_station.station_id', '=', $request->station_id_end)->get(['order'])->first()->order;
        // dd($stationEndIndex);
        // dd($stationStartIndex);
        // dd($phone);
        // $stationStartIndex = $route->getStations()->where('route_station.station_id', '=', $request->station_id_start)->get()->first()->order;
        // $stationEndIndex = $route->getStations()->where('route_station.station_id', '=', $request->station_id_end)->get()->first()->order;
        $total = $this->getTotal($route, $stationStartIndex, $stationEndIndex, $count);
        $newTicket = new TicketModel;
        $newTicket->phone = $phone;
        $newTicket->route_id = $route_id;
        $newTicket->station_id_start = $request->station_id_start;
        $newTicket->station_id_end = $request->station_id_end;
        $newTicket->total = $total;
        if ($newTicket->save()) {
            return response(['message' => 'create susscess'], 202);
        } else {
            return response(['message' => 'create fail'], 202);
        }
    }
    public function getTotal($route, $stationStartIndex, $stationEndIndex, $count)
    {

        $result = $route->min_cost;
        $length = $stationEndIndex - $stationStartIndex + 1;
        if ($length > ceil(count($route->getStations()->get()) / 2)) {
            $result += ($length - ceil(count($route->getStations()->get()) / 2)) * $route->cost;
        }
        return  $result * $count;
    }
    public function getInfoByPhone(Request $request)
    {
        return  TicketResource::collection(TicketModel::where('phone', '=', $request->phone)->get());
    }
}

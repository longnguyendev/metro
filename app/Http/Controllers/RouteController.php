<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouteModel;
use App\Http\Resources\RouteResource;

class RouteController extends Controller
{
    //
    public function getAllAPI()
    {
        $result = RouteModel::all(); //RouteModel[] =>json
        return RouteResource::collection($result);
    }


    public function getStationsByRouteId($id)
    {
        $result = RouteModel::findOrFail($id);
        return new RouteResource($result);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouteModel;
use App\Http\Resources\RouteResource;

class RouteController extends Controller
{
    //
    public function getRoutesAPI()
    {
        return RouteResource::collection(RouteModel::all());
    }

    public function getStationByRouteID($id)
    {
        return new  RouteResource(RouteModel::findOrFail($id));
    }
}

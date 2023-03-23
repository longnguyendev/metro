<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\RouteModel;
use App\Http\Resources\StationResource;

class RouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'route_id' => $this->route_id,
            'name' => $this->name,
            'length' => $this->lenght,
            'min_cost' => $this->min_cost,
            'cost' => $this->cost,
            'stations' => StationResource::collection($this->getStations()->get())
        ];
    }
}

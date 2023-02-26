<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'route_id' => $this->route_id,
            'opt_time' => $this->opt_time,
            'name' => $this->name,
            'length' => $this->length,
            'cost' => $this->cost,
            'min_cost' => $this->min_cost,
            'stations' => $this->getStations()->get()
        ];
    }
}

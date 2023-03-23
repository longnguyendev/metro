<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\TicketController;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ticket_id' => $this->ticket_id,
            'create_at' => $this->created_at,
            'route_name' => $this->getRouteName($this->route_id),
            'station_name_start' => $this->getStationName($this->station_id_start),
            'station_name_end' => $this->getStationName($this->station_id_end),
            'total' => $this->total
        ];
    }
}

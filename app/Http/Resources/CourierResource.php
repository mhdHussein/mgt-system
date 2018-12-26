<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Model\Attendance;

class CourierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $attended = Attendance::where('courier_id' , $this->id)
                                ->where('created_at' , Carbon::today())->count();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'email' => $this->email,
            'id_number' => $this->id_number,
            'iqama' => $this->iqama,
            'mobile' => $this->mobile,
            'nationality' => $this->nationality,
            'car_type' => $this->car_type,
            'plate' => $this->plate,
            'supervisor_id' => $this->supervisor_id,
            'supervisor' => $this->supervisor->name,
            'warehouse' => $this->supervisor->warehouse->name,
            'city' => $this->supervisor->warehouse->city->name,
            'attended' => $attended,
            'hire_date' => date('d/M/Y', strtotime($this->hire_date)),
            'notes' => $this->notes,
            'created_at' => date('d/M/Y', strtotime($this->created_at))
        ];
    }
}

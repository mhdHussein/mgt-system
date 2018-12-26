<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DateTime;
class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $date = date('d-M-Y', strtotime($this->created_at));
        $lateHours = $this->created_at->diff(new DateTime($date . ' 09:00:00'))->h;
        $lateMinutes = $this->created_at->diff(new DateTime($date . ' 09:00:00'))->i;

        $totalHours = (($lateHours * 60 ) + $lateMinutes) / 60;

        return [
            'id' => $this->id,
            'courier' => $this->courier->name,
            'status' => $this->courier->status,
            'supervisor' => $this->supervisor->name,
            'time' => date('h:i A', strtotime($this->created_at)),
            'date' => $date,
            'lateTime' => $lateHours . ':' . $lateMinutes,
            'lateTimeNumber' =>  number_format((float)$totalHours, 2, '.', '')
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleCourierShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'courier_id' => $this->courier->id,
            'courier_number' => $this->courier->id_number,
            'courier' => $this->courier->name,
            'supervisor' => $this->courier->supervisor->name,
            'total_sent' =>  number_format((float)$this->sent_count, 2, '.', ''),
            'amount_sent' =>  number_format((float)$this->sent_amount, 2, '.', ''),
            'total_cash' =>  number_format((float)$this->cash, 2, '.', ''),
            'total_credit' =>  number_format((float)$this->credit, 2, '.', ''),
            'deposited' =>  number_format((float)$this->deposited_amount, 2, '.', ''),
            'returned' =>  number_format((float)$this->returned_shipments, 2, '.', ''),
            'delivered' =>  number_format((float)$this->delivared_shipments, 2, '.', ''),
            'deficit' =>  number_format((float)$this->fiscal_deficit, 2, '.', ''),
            'lost' =>  number_format((float)$this->lost_shipments, 2, '.', ''),
            'fuel' =>  number_format((float)$this->fuel, 2, '.', ''),
        ];
    }
}

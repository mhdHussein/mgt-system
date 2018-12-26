<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $averageAmount = $this->recieved / $this->total_attendance;

        $shipmentPrice = 0;

        if($averageAmount >= 1 && $averageAmount <= 10){
            $shipmentPrice = 10;
        }else  if($averageAmount >= 11 && $averageAmount <= 16){
            $shipmentPrice = 13;
        }else {
            $shipmentPrice = 15;
        }

        $salary = $this->recieved * $shipmentPrice * 8.65384;
        $profit = ($this->total_cash + $this->total_credit) * $averageAmount;
        $netProfit = $profit - $salary;

        $average = $this->delivered / $this->recieved;

        // productivity = total delivered / courier count

        return [
            'courier_id' => $this->courier->id,
            'courier_number' => $this->courier->id_number,
            'courier' => $this->courier->name,
            'supervisor' => $this->courier->supervisor->name,
            'total_sent' =>  number_format((float)$this->recieved, 2, '.', ''),
            'amount_sent' =>  number_format((float)$this->recieved_amount, 2, '.', ''),
            'total_cash' =>  number_format((float)$this->total_cash, 2, '.', ''),
            'total_credit' =>  number_format((float)$this->total_credit, 2, '.', ''),
            'deposited' =>  number_format((float)$this->total_deposited, 2, '.', ''),
            'returned' =>  number_format((float)$this->returned, 2, '.', ''),
            'deficit' =>  number_format((float)$this->deficit, 2, '.', ''),
            'lost' =>  number_format((float)$this->lost, 2, '.', ''),
            'delivered' =>  number_format((float)$this->delivered, 2, '.', ''),
            'average_delivered' =>  number_format((float)$average, 2, '.', ''),
            'fuel' =>  number_format((float)$this->fuel, 2, '.', ''),
            'total_attendance' =>  number_format((float)$this->total_attendance, 2, '.', ''),
            'shipment_price' =>    number_format((float)$shipmentPrice, 2, '.', ''),
            'salary' =>  number_format((float)$salary, 2, '.', ''),
            'revenue' =>  number_format((float)$profit, 2, '.', ''),
            'net_profit' => number_format((float)$netProfit, 2, '.', '') 
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'nationality' => $this->nationality,
            'marital_status' => $this->marital_status,
            'birth_date' => date('d/M/Y', strtotime($this->birth_date)),
            'hire_date' => date('d/M/Y', strtotime($this->hire_date)),
            'iqama_exp' => date('d/M/Y', strtotime($this->iqama_exp)),
            'iqama' => $this->iqama,
            'mobile' => $this->mobile,
            'proffesion' => $this->proffesion,
            'sponsorship_transfer' => $this->sponsorship_transfer,
            'insurance' => $this->insurance,
            'division' => $this->division,
            'job_title' => $this->job_title,
            'salary' => $this->salary,
            'department' => $this->department['name'],
            'city' => $this->city['name'],
            'notes' => $this->notes,
        ];
    }
}

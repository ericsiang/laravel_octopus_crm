<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberApiResource extends JsonResource
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
            'card_num'=>$this->card_num,
            'name' => $this->name,
            'email' => $this->email,
            'phone'=> $this->phone,
            'sex'=> $this->phone,
            'city_id'=> $this->city_id,
            'area_id'=> $this->area_id,
            'address'=> $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
           
        ];
        //return parent::toArray($request);
    }
}

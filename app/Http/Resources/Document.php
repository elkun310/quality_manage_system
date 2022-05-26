<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product as ProductResource;

class Document extends JsonResource
{
    public $preserveKeys = true;

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
            'name_company' => $this->name_company,
            'address' => $this->address,
            'email' => $this->email,
            'products' => ProductResource::collection($this->products),
            'secret' => $this->when((int)$this->area_receive === 2, '12312321'),
            $this->mergeWhen((int)$this->area_receive === 2, [
                'first-secret' => 'value',
                'second-secret' => 'value',
            ]),
            'updated_at' => $this->updated_at,
        ];
    }
}

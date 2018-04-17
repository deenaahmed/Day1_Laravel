<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'my_new_title' =>$this->title,
            'my_new_description' =>$this->description,
            'my_new_user' =>new UserResource($this->user),
        ];
    }
}

<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class RepositoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "repository_id"=>$this->repository_id,
            "repository_name"=>$this->repository_name,
            "description"=>$this->description,
            "url"=>$this->url,
            "language"=>$this->language,
        ];
    }
}

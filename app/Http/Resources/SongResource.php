<?php

namespace App\Http\Resources;

use App\Models\Pisac;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\KategorijaResource;
use App\Http\Resources\PisacResource;
use App\Http\Resources\UserResource;

class SongResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'song';
    public function toArray($request)
    {
        return [
            'title'=>$this->resource->title,
            'category_id'=> new CategoryResource($this->resource->category),
            'author_id'=> new AuthorResource($this->resource->author),
            'user'=> new UserResource($this->resource->user)
        ];
    }
}

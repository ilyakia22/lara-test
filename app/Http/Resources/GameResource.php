<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $genres = [];
        foreach ($this->genres as $genre) {
            $genres[] = ['genre_id' => $genre->id, 'genre_name' => $genre->name];
        }


        return [
            'game_id' => $this->id,
            'game_name' => $this->name,
            'development_studio' => [
                'development_studio_id' => $this->developmentStudio->id,
                'development_studio_name' => $this->developmentStudio->name
            ],
            'genres' => $genres
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WordApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'en_word' => $this->en_word, 
            'ja_word' => $this->ja_word, 
            'en_sentence' => $this->en_sentence, 
            'ja_sentence' => $this->ja_sentence, 
            'description' => $this->description, 
            'name' => $this->name, 
            'email' => $this->email, 
            'level' => $this->level, 
            'is_show' => $this->is_show, 
        ];
    }
}

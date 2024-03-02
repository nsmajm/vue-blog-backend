<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'published_date' => Carbon::parse($this->created_at)->format('F d,Y'),
            'title' => $this->title,
            'short_desc' => $this->short_title,
            'image_url' => Voyager::image($this->thumbnail),
            'large_image' => Voyager::image($this->image),
        ];
    }
}

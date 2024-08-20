<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    private $statusText;
    private $statusCode;
    public function __construct($resource, $statusCode = '404', $statusText = 'success')
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'data' => $this->collection,
            'status' => $this->statusCode,
            'title' => $this->statusText,
            'count' => $this->collection->count()
        ];
    }
}

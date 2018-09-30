<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GenericJsonResource extends JsonResource
{
    private $resultMessage;
    private $isSuccess;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($message, $isSuccess = true)
    {
        $this->resultMessage = $message;
        $this->isSuccess = $isSuccess;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [];
    }

    /**
     * Returns other attributes to the request
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request)
    {
        return [
            'status' => $this->isSuccess ? 'success' : 'error',
            'message' => $this->resultMessage,
        ];
    }

    protected function modelAsArray()
    {
        return parent::toArray();
    }
}

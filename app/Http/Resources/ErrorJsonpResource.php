<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorJsonpResource extends JsonResource
{
    private $errorMessage;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->errorMessage = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [],
        ];
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
            'status' => 'fail',
            'message' => $this->errorMessage,
        ];
    }

    /**
     * Customize the response for a request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\JsonResponse  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->withCallback($request->input('callback'));
    }
}

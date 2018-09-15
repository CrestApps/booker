<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomersResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];
        foreach ($this->collection as $customer) {
            $data[] = [
                'value' => $customer->id,
                'label' => $customer->fullname,
            ];
        }

        return [
            'data' => $data,
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
            'status' => 'success',
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

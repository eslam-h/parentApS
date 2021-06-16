<?php
namespace App\Http\Resources\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class AbstractJsonResource extends JsonResource
{
    /**
     * @var
     */
    protected $request;

    /**
     * @return array
     */
    abstract public function modelResponse() : array;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (is_null($this->resource)) {
            return [];
        }

        if (is_array($this->resource)) {
            return $this->resource;
        }
        $this->request = $request;
        return $this->modelResponse();
    }

}

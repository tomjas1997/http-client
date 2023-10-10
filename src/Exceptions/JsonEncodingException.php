<?php

namespace Invertus\Http\Exceptions;

use Invertus\Http\Resources\Json\JsonResource;

class JsonEncodingException extends \RuntimeException
{
    /**
     * Create a new JSON encoding exception for the resource.
     *
     * @param  JsonResource $resource
     * @param  string  $message
     * @return static
     */
    public static function forResource($resource, $message)
    {
        $model = $resource->resource;

        return new static('Error encoding resource ['.get_class($resource).'] with model ['.get_class($model).'] with ID ['.$model->getKey().'] to JSON: '.$message);
    }
}
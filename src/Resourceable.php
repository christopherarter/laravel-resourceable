<?php

namespace Arter\Resources\Resourceable;

use Illuminate\Http\Resources\Json\JsonResource;

trait Resourceable
{
    protected $apiResource;

    /**
     * Returns the resource associated with this
     * class.
     *
     * @param string $class
     * @param $request
     * @return array
     */
    public function toResourceArray(string $class = null, $request = null) : array
    {
        if (!$class) {
            $class = $this->resolveResourceName();
        }

        if ( $class 
            && class_exists($class)
            && is_subclass_of($class,JsonResource::class) ) {
            return (new $class($this))->resolve($request);
        }

        return $this->toArray();
    }

    /**
     * Resolves the resource class name according
     * to standard naming convention.
     *
     * @return string|boolean
     */
    private function resolveResourceName()
    {
        return (class_exists(self::class . 'Resource')) ?? null;
    }
}
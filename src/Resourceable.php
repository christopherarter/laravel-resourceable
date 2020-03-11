<?php

namespace Arter\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

trait Resourceable
{
    /**
     * Returns the resource associated with this
     * class.
     *
     * @param string|null $class
     * @param Request|null $request
     * @return array
     */
    public function toResourceArray(?string $class = null, ?Request $request = null): array
    {

        $class = $class ?: $this->resolveResourceName();

        if (class_exists($class) && is_subclass_of($class, JsonResource::class)) {
            return json_decode(( new $class($this))->response()->content(), true);
        }

        return $this->toArray();
    }

    /**
     * Resolve the resource class according to standard
     * naming convention.
     *
     * @return string
     */
    protected function resolveResourceName(): string
    {
        $reflect = new \ReflectionClass($this);
        return "\\{$reflect->getNamespaceName()}\\Http\\Resources\\{$reflect->getShortName()}Resource";
    }
}
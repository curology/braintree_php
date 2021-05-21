<?php

namespace Braintree\Traits;

trait CanBeSerialized
{
    /**
     * Implementation of JsonSerializable
     *
     * @ignore
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Implementation of to an Array
     *
     * @ignore
     * @return array
     */
    public function toArray()
    {
        return array_map(function ($value) {
            if ($value === null) {
                return null;
            }

            if (is_array($value)) {
                $subValues = [];
                foreach ($value as $subValue) {
                    $subValues[] = method_exists($subValue, 'toArray') ? $subValue->toArray() : $subValue;
                }

                return $subValues;
            }

            return method_exists($value, 'toArray') ? $value->toArray() : $value;
        }, $this->_attributes);
    }
}

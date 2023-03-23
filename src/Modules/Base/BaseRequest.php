<?php

namespace Shitutech\Shareable\Modules\Base;

abstract class BaseRequest
{
    public abstract function getApiPath(): string;

    /**
     * @param bool $toJson
     * @return array|false|string
     */
    public function fetchBizData(bool $toJson = true)
    {
        $bizData = [];

        $clzProperties = get_object_vars($this);

        $ignoreEmptyProperties = [];
        if (
            defined('static::IGNORE_EMPTY_PROPERTIES') &&
            static::IGNORE_EMPTY_PROPERTIES && is_array(static::IGNORE_EMPTY_PROPERTIES)
        ) {
            $ignoreEmptyProperties = static::IGNORE_EMPTY_PROPERTIES;
        }

        foreach ($clzProperties as $property => $propertyValue) {
            if ($ignoreEmptyProperties && in_array($property, $ignoreEmptyProperties) && trim($propertyValue) === '') {
                continue;
            }

            $bizData[$property] = $propertyValue;
        }

        return $toJson ? json_encode($bizData) : $bizData;
    }

    /**
     * @param string $name
     * @param $value
     * @return void
     */
    public function __set(string $name, $value)
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
    }
}
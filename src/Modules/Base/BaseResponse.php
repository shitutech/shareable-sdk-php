<?php

namespace Shitutech\Shareable\Modules\Base;

abstract class BaseResponse
{
    /**
     * @param array $resultData
     * @return void
     */
    public function setProperty(array $resultData)
    {
        foreach ($resultData as $name => $value) {
            if (property_exists($this, $name)) {
                $pType = gettype($this->{$name});
                switch ($pType) {
                    case 'boolean':
                        $value = (boolean)$value;
                        break;
                    case 'array':
                        $value = (array)$value;
                        break;
                    case 'NULL':
                    case 'object':
                        break;
                    case 'integer':
                        $value = intval($value);
                        break;
                    case 'float':
                    case 'double':
                        $value = floatval($value);
                        break;
                    case 'string':
                    default:
                        $value = $value === null ? '' : trim($value);
                        break;
                }

                $this->{$name} = $value;
            }
        }
    }

    public function toArray(): array
    {
        $bizData = [];

        $clzProperties = get_object_vars($this);

        foreach ($clzProperties as $property => $propertyValue) {
            $bizData[$property] = $propertyValue;
        }

        return $bizData;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
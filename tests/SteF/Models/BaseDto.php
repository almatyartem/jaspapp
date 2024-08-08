<?php

namespace Tests\SteF\Models;

abstract class BaseDto
{
    protected array $_attributes = [];
    protected array $_setNull = [];

    public function fill(array $data, array $only = null, array $exclude = null){
        foreach ($data as $field => $value) {
            if($only && !in_array($field, $only)){
                continue;
            }
            if($exclude && in_array($field, $exclude)){
                continue;
            }
            if(is_null($value)){
                $this->_setNull[] = $field;
            }
            if(!property_exists($this, $field)){
                $this->_attributes[$field] = $value;
            }
        }
    }

    public function toArray(): array
    {
        $data = call_user_func('get_object_vars', $this);
        unset($data['_attributes']);
        unset($data['_setNull']);

        return array_merge($this->_attributes, $data);
    }

    public function __get(string $param){
        return $this->_attributes[$param] ?? null;
    }

    public function data() : array
    {
        return $this->toArray();
    }
}

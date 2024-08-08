<?php

namespace Tests\SteF\Models;


class BaseRequestDto extends BaseDto
{
    protected array $routeParamNames = [];

    public function routeParams() : array
    {
        return $this->renameRouteParams($this->prepareData($this->toArray(), null, $this->getRouteParamNames()));
    }

    public function data() : array
    {
        $data = $this->prepareData($this->toArray(), array_merge(['routeParamNames'], $this->getRouteParamNames()));

        return $data;
    }

    public function setRouteParamNames(array $params) : self
    {
        $this->routeParamNames = $params;

        return $this;
    }

    protected static function isRemoveNullsActive() : bool
    {
        return true;
    }

    protected static function replaceNullFor() : ?string
    {
        return '__null__';
    }

    protected function getRouteParamNames() : ?array
    {
        $routeKeys = $this->routeParamNames;

        foreach($this->toArray() as $key => $value){

            if(str_contains($key, 'route:')){
                $routeKeys[] = $key;
                if($k = array_search(str_replace('route:', '', $key), $routeKeys)){
                    unset($routeKeys[$k]);
                }
            }
        }

        return $routeKeys;
    }

    protected function prepareData(array $data, array $excludeKeys = null, array $includeKeys = null) : array
    {
        if(!is_null($includeKeys)){
            $data = array_intersect_key($data, array_flip($includeKeys));
        }
        if(!is_null($excludeKeys)){
            $data = array_diff_key($data, array_flip($excludeKeys));
        }

        return static::isRemoveNullsActive() ? $this->removeNulls($data) : $data;
    }

    protected function removeNulls(array $data) : array
    {
        return array_filter($data, function($value, $key) {
            return !is_null($value) || in_array($key, $this->_setNull);
        }, ARRAY_FILTER_USE_BOTH);
    }

    protected function renameRouteParams(array $routeData) : array
    {
        foreach ($routeData as $routeParamName => $routeParamValue) {
            if(strpos($routeParamName, "route:") !== false) {
                $routeData[str_replace("route:","", $routeParamName)] = $routeParamValue;
                unset($routeData[$routeParamName]);
            }
        }

        return $routeData;
    }
}

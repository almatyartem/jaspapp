<?php

namespace App\Http\Requests;

abstract class BaseChangingRequest extends BaseApiRequest
{
    abstract protected function allRules() : array;
    protected function usedRulesKeys() : array
    {
        return array_keys($this->allRules());
    }

    public function rules(): array
    {
        return array_intersect_key($this->allRules(), array_flip($this->usedRulesKeys()));
    }
}

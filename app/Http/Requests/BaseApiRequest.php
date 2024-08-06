<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseApiRequest extends FormRequest
{
    protected function tableName(string $modelClass) : string
    {
        return app($modelClass)->getTable();
    }
}

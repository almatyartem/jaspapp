<?php

namespace App\Models\Base;

use App\Models\Interfaces\TunedModel;
use App\Models\Traits\HasTuning;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model implements TunedModel
{
    use HasTuning;

    protected $guarded = [];
}
